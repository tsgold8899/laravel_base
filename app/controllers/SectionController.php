<?php

class SectionController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    
    public $user;
    
    private function set_user() {
        $this->user = User::find(Sentry::getUser()->id);
    }
    
    public function __construct() {
        $this->set_user();
    }
    
    public function index()
    {
        $user = $this->user;
        $sections = $user->sections()->get();
        $s0 = $user->sections()->where('x', '=', 0)->orderby('y')->get();
        $s1 = $user->sections()->where('x', '=', 1)->orderby('y')->get();
        $s2 = $user->sections()->where('x', '=', 2)->orderby('y')->get();
        // $mlinks = Link::where('user_id', '=', $user->id)->wherenull('section_id')->get();
        $mlinks = Link::where('user_id', '=', $user->id)->where('name', '=', '')->get();
        
        $view_mode_switched = Input::get('view_mode_switched');
        if ($view_mode_switched && $view_mode_switched == 1) {
            Session::put('welcome_section_mode', 'To add a new section, select "Add" above.');
        }
        
        return View::make('section.index')
            ->with('user', $user)
            ->with('sections', $sections)
            ->with('mlinks', $mlinks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('section.create')->with('user', $this->user);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $user = $this->user;
        $input = Input::all();
        
        $success = false;
        $message = "";
        
        try{
            $section = new Section;
            $section->user_id = $user->id;
            $section->name = $input['name'];
            $success = $section->save();
            $message = 'New section ['.$section->name.'] has been created successfully';
            
        } catch (\Exception $e) {
            $message = $e->getMessage();
            
        }

        if (Request::ajax()) {
            return array(
                    'code'      => ($success) ? 1 : 0,
                    'message'   => $message,
                    'data'      => $section->id
                );
        } else {
            if ($success) {
                Session::put('success', 'New section ['.$section->name.'] has been created successfully');
            } else {
                Session::put('error', $e->getMessage());
            }
            
            if (isset($input['continue']) && $input['continue'] == 1) {
                return Redirect::action('SectionController@create')->with('method', 'GET');
            } else {
                return Redirect::action('SectionController@index')->with('method', 'GET');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
        
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->user;
        $section = Section::find($id);
        $links = $section->links()->get();
        return View::make('section.edit')->with('user', $user)->with('section', $section)->with('links', $links);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $user = $this->user;
        $input = Input::all();
        try {
            $section = Section::find($id);
            $section->name = $input['name'];
            $section->save();
            Session::put('success', 'The section['.$section->name.'] has been updated successfully');
        } catch(\Exception $e) {
            Session::put('error', $e->getMessage());
        }
        return Redirect::action('SectionController@index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->user;
        $section = Section::find($id);
        $section->links()->delete();
        $section->delete();
        
        // return "success";
        return array(
            'code'      => 1,
            'message'   => 'The section has been deleted successfully',
            'data'      => $id
        );
    }
    
    /*
     * to refresh whole items in drop down list "Sections"
     */
    public function getSections() {
        if (Request::ajax()) {
            $sections = $this->user->sections()->get();
            $section_selector = array();
            // $section_selector['0'] = 'Choose a section';
            $section_selector[] =  array('id'=>'0', 'name'=>'Choose a section');
            foreach ($sections as $section) {
                // $section_selector[$section->id] = $section->customizedName();
                $section_selector[] = array('id'=>$section->id, 'name'=>$section->customizedName());
            }
            
            return array(
                'code'      => 1,
                'message'   => 'Secions has been fetched successfully',
                'data'      => $section_selector
            );
             //return var_dump($section_selector);
        }
    }
    
    public function newSection() {
        if (Request::ajax()) {
            try{
                $section_id = Input::get('section_id');
                $section = Section::find($section_id);
                $links = $section->links()->get();
                $view = View::make('section.new')->with('section', $section)->with('links', $links);
                return array(
                    'code'      => 1,
                    'message'   => 'Here comes new section panel',
                    'data'      => $view->render()
                    // 'data'      => $str
                );
            } catch(\Exception $e) {
                return $e->getMessage();
            }
        }
    }
    
    public function createLink()
    {
        $input = Input::all();
        $sections = $this->user->sections()->get();
        $section_selector = array();
        $section_selector[0] = 'Choose a section';
        foreach ($sections as $section) {
            $section_selector[$section->id] = $section->customizedName();
        }
        
        if (isset($input['section_id'])) {
            return View::make('section.createLink')->with('user', $this->user)->with('section_selector', $section_selector)->with('section_id', $input['section_id']);
        } else {
            return View::make('section.createLink')->with('user', $this->user)->with('section_selector', $section_selector)->with('section_id', 0);
        }
    }
    
    public function storeLink()
    {
        $user = $this->user;
        $input = Input::all();
        
        try{
            $link = new Link;
            $link->user_id = $user->id;
            $link->name = $input['name'];
            $link->url = $input['url'];
            if (isset($input['section_id']) && $input['section_id'] > 0) {
                $link->section_id = $input['section_id'];
            }
            $link->save();
            Session::put('success', 'New link ['.$link->name.'] has been created successfully');
        } catch (\Exception $e) {
            Session::put('error', $e->getMessage());
        }
        
        if (isset($input['continue']) && $input['continue'] == 1) {
            return Redirect::action('SectionController@createLink')->with('method', 'GET');
        } else {
            return Redirect::action('SectionController@index')->with('method', 'GET');
        }
    }

    public function editLink($section_id, $id)
    {
        $input = Input::all();
        $link = Link::find($id);
        
        return View::make('section.editLink')->with('user', $this->user)->with('link', $link);
    }
    
    public function updateLink($section_id, $id)
    {   
        $input = Input::all();
        $link  = Link::find($id);
        
        try {
            $link->name = $input['name'];
            $link->url = $input['url'];
            $link->save();
            Session::put('success', 'The link ['.$link->name.'] has been updated successfully');
        } catch(\Exception $e) {
            Session::put('error', $e->getMessage());
        }
        return Redirect::action('SectionController@edit', $section_id);
    }

    public function saveSectionOrder() {
        $input = Input::all();
        /*
        $section_order2 = $input['orders'];
        
        foreach($section_order2 as $section_order1) {
            foreach ($section_order1 as $section_order) {
                $section = Section::find($section_order['id']);
            }
        }
         */
         
        $orders = $input['orders'];
        foreach ($orders as $order) {
            $section = Section::find($order['id']);
            $section->x = $order['x'];
            $section->y = $order['y'];
            $section->save();
        }
    }

    public function saveLinkOrder() {
        $input = Input::all();
        $orders = $input['orders'];
        foreach ($orders as $order) {
            $link = Link::find($order['id']);
            $link->section_id = $order['section_id'];
            $link->x = 0;
            $link->y = $order['y'];
            $link->save();
        }
    }
}
