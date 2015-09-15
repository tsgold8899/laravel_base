<?php

class LinkController extends \BaseController {

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
        $sort_by = Input::get('sort_by');
        
        // save the option 
        $key = 'link_sort_by';
        $sort_by = $sort_by ?  (int) $sort_by : (int) OptionHelper::getValue($this->user->id, $key);
        $value = (string) $sort_by;
        OptionHelper::setValue($this->user->id, $key, $value);
        
        $user = $this->user;
        $links = $user->links();
        
        if ($links->count() > 0) {
        
            if ($sort_by == 0) {
                // $bookmarks->orderby('visited_count', 'desc');
            } else if ($sort_by == 1) {
                $links->orderby('name', 'asc');
            } else if ($sort_by == 2) {
                $links->orderby('visited_count', 'desc');
            }
            $links = $links->get();

            return View::make('link.index')->with('user', $user)->with('links', $links);
        } else {
            $presections = Section::where('user_id', '=', 0)->get();
            Session::forget('welcome');
            return View::make('link.setup')->with('user', $user)->with('sections', $presections);
        }
    }

    /**
     * done in setup
     * 
     */
     
     public function installed() {
         $user = $this->user;
         $input = Input::all();
         
         if (isset($input["links"])) {
             $link_ids = $input["links"];
             if ($link_ids && count($link_ids) > 0) {
                 // delete sections
                 Section::where('user_id', '=', $user->id)->delete();
                 
                 // create 'Miscellaneous' section
                 $missection = new Section;
                 $missection->user_id = $user->id;
                 $missection->name = "";
                 $missection->order = 0;
                 $missection->x = 0;
                 $missection->y = 0;
                 $missection->save();
                 
                 // save links
                 $link_order = 0;
                 $section_order = 0;
                 foreach ($link_ids as $link_id) {
                     $link_order ++;
                     $prelink = Link::find($link_id);
                     $presection = Section::find($prelink->section_id);
                     
                     // find / create a section
                     $section = null;
                     if ($presection->name == 'Miscellaneous') {
                         $section = $missection;
                     } else {
                        // $section = Section::firstOrNew(array('user_id' => $user->id, 'name' => $presection->name));
                        $section = $user->sections()->where('name', '=', $presection->name)->first();
                        if ($section && $section->id > 0) {
                            
                        } else {
                            $section_order ++;
                            $section = new Section;
                            $section->user_id = $user->id;
                            $section->name = $presection->name;
                            $section->order = $section_order;
                            $section->x = $section_order % 3;
                            $section->y = $section_order / 3;
                            if ($section->save()) {
                                // Session::put('success', 'Success 01');
                                // return Redirect::action('LinkController@index')->with('user', $user);
                            } else {
                                $section = null;
                                // Session::put('error', 'Error 01');
                                // return Redirect::action('LinkController@index')->with('user', $user);
                            }
                        }
                     }
                     
                     // save a link
                     $link = new Link;
                     $link->user_id = $this->user->id;

                     if ($section) {
                         $link->section_id = $section->id;
                     }
                     
                     $link->name = $prelink->name;
                     $link->url = $prelink->url;
                     $link->order = $link_order;
                     $link->save();
                 }
             } else {
                 Session::put('error', 'Please select at least 1 link.');
             }
         } else {
             Session::put('error', 'Please select at least 1 link.');
         }
         return Redirect::action('LinkController@index')->with('user', $user);
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('link.create')->with('user', $this->user);
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
        
        try{
            $link = new Link;
            $link->user_id = $user->id;
            $link->name = $input['name'];
            $link->url = $input['url'];
            $link->save();
            Session::put('success', 'New link ['.$link->name.'] has been created successfully');
        } catch (\Exception $e) {
            Session::put('error', $e->getMessage());
        }
        
        if (isset($input['continue']) && $input['continue'] == 1) {
            return Redirect::action('LinkController@create')->with('method', 'GET');
        } else {
            return Redirect::action('LinkController@index')->with('method', 'GET');
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
        $link = Link::find($id);
        return View::make('link.edit')->with('user', $user)->with('link', $link);
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
        // $input = Input::all();
        try {
            $link = Link::find($id);
            $link->name = Input::get('name');
            $link->url = Input::get('url');
            $link->save();
            Session::put('success', 'The link['.$link->name.'] has been updated successfully');
        } catch(\Exception $e) {
            Session::put('error', $e->getMessage());
        }
        return Redirect::action('LinkController@index');
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
        // $user = Sentry::getUser();
        
        $link = Link::find($id);
        $link->delete();
        
        // return "success";
        return array(
            'code'      => 1,
            'message'   => 'The link has been deleted successfully',
            'data'      => $id
        );
    }

    public function visiting($id)
    {
        try {
            $link = Link::find($id);
            $link->visited_count ++;
            $link->last_visited_at = new DateTime;
            $link->save();
            return array(
                'code'      => 1,
                'message'   => 'visiting history has been updated successfully',
                'data'      => ''
            );
        } catch(\Exception $e) {
            return array(
                'code'      => 0,
                'message'   => $e->getMessage(),
                'data'      => ''
            );
        }
    }
}
