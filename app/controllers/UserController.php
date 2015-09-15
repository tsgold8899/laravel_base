<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
    
    /*
     * change email
     */
     
    public function changeEmail($id) {
        $user = Sentry::findUserById($id);
        $input = Input::all();
        try{
            if (isset($input['newEmail'])) {                
                if (Sentry::findUserByLogin($input['newEmail'])) {
                    throw new Exception('A user with new email is alreay existed');    
                } else {
                    return "oh, my god !";
                }
            } else {
                return View::make('user.changeEmail')->with('user', $user);
            }
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            $user->email = $input['newEmail'];
            $user->save();
            Session::put('success', 'Email has been updated successfully');
            return Redirect::back();            
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
        }
        
        Session::put('error', $errorMessage);
        return View::make('user.changeEmail')->with('user', $user);
        /*
        ->with(array(
            'code'      => 0,
            'message'   => $errorMessage
        ));
        */
    }
    
    /*
     * chage password
     */
    public function changePassword($id) {
        $user = Sentry::findUserById($id);
        $input = Input::all();
        try{
            if (isset($input['newPassword']) && isset($input['confirmPassword']) && $input['newPassword'] == $input['confirmPassword']) {
                $user->password = $input['newPassword'];                
                $user->save();
                Session::put('success', 'Password has been updated successfully');
                return Redirect::back();
            } else {
                return View::make('user.changePassword')->with('user', $user);
            }
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
        }
        
        Session::put('error', $errorMessage);
        return View::make('user.changePassword')->with('user', $user);
    }
    
    public function saveOption($id) {
        // $user = Sentry::getUser();
        $key = Input::get('key');
        $value = Input::get('value');
        /*
        return array(
            'code'      => 1,
            'message'   => "success",
            'data'      => $user->email
        );         
         */
        return OptionHelper::setValue($id, $key, $value);
    }
}
