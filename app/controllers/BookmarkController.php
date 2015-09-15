<?php

class BookmarkController extends \BaseController {

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
		// $user = User::find(Sentry::getUser()->id);
		$sort_by = Input::get('sort_by');
        // $sort_by = $sort_by ? (int) $sort_by : 0;
        
        // save the option 
        $key = 'link_sort_by';
        $sort_by = $sort_by ?  (int) $sort_by : (int) OptionHelper::getValue($this->user->id, $key);
        $value = (string) $sort_by;
        OptionHelper::setValue($this->user->id, $key, $value);
        
		$user = $this->user;
		$bookmarks = $user->bookmarks();
        
        if ($bookmarks->count() > 0) {
        
            if ($sort_by == 0) {
                // $bookmarks->orderby('visited_count', 'desc');
            } else if ($sort_by == 1) {
                $bookmarks->orderby('name', 'asc');
            } else if ($sort_by == 2) {
                $bookmarks->orderby('visited_count', 'desc');
            }
            $bookmarks = $bookmarks->get();
            //$bookmarks = Bookmark::where('user_id', '=', $user->id)->get();
    		// $bookmarks = Bookmark::all();
    		return View::make('bookmark.index')->with('user', $user)->with('bookmarks', $bookmarks);
        } else {
            $sections = Section::where('user_id', '=', 0)->get();
            Session::forget('welcome');
            return View::make('bookmark.setup')->with('user', $user)->with('sections', $sections);
        }
	}

    /**
     * done in setup
     * 
     */
     
     public function installed() {
         $input = Input::all();
         if (isset($input["links"])) {
             $link_ids = $input["links"];
             if ($link_ids && count($link_ids) > 0) {
                 foreach ($link_ids as $link_id) {
                     $link = Link::find($link_id);
                     
                     $bookmark = new Bookmark();
                     $bookmark->user_id = $this->user->id;
                     $bookmark->name = $link->name;
                     $bookmark->url = $link->url;
                     $bookmark->save(); 
                 }
             } else {
                 Session::put('error', 'Please select at least 1 link.');
             }
         } else {
             Session::put('error', 'Please select at least 1 link.');
         }
         return Redirect::action('BookmarkController@index')->with('user', $this->user);
     }


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		// return View::make('bookmark.create')->with('user', Sentry::getUser());
		return View::make('bookmark.create')->with('user', $this->user);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$user = $this->user;
		// $user = Sentry::getUser();
        // $bookmark = $user->bookmarks()->new();
        $input = Input::all();
		
        try{
    		$bookmark = new Bookmark;
            $bookmark->user_id = $user->id;
            $bookmark->name = $input['name'];
            $bookmark->url = $input['url'];
            $bookmark->save();
            Session::put('success', 'New link ['.$bookmark->name.'] has been created successfully');
        } catch (\Exception $e) {
            Session::put('error', $e->getMessage());
        }
        
        if (isset($input['continue']) && $input['continue'] == 1) {
            return Redirect::action('BookmarkController@create')->with('method', 'GET');
        } else {
            return Redirect::action('BookmarkController@index')->with('method', 'GET');
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
		// $user = User::find(Sentry::getUser()->id);
        $bookmark = Bookmark::find($id);
        return View::make('bookmark.edit')->with('user', $user)->with('bookmark', $bookmark);
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
		// $user = Sentry::getUser();
        // $input = Input::all();
        try {
            $bookmark = Bookmark::find($id);
            $bookmark->name = Input::get('name');
            $bookmark->url = Input::get('url');
            $bookmark->save();
            Session::put('success', 'The link['.$bookmark->name.'] has been updated successfully');
        } catch(\Exception $e) {
            Session::put('error', $e->getMessage());
        }
        // return var_dump(Input::all());
        // return View::make('bookmark.edit')->with('user', $user)->with('bookmark', $bookmark);
        return Redirect::action('BookmarkController@index');
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
        
        $bookmark = Bookmark::find($id);
        $bookmark->delete();
        
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
            $bookmark = Bookmark::find($id);
            $bookmark->visited_count ++;
            $bookmark->last_visited_at = new DateTime;
            $bookmark->save();
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
