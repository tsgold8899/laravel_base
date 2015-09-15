<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		return View::make('hello');
	}
    
    public function home() {
        return View::make('home.home');
    }
    
    public function signin() {
        $activated = true;
        $errorMessage = 'Failed in sign in.';
        
        $user = new User();
        // $user->email = '';
        // $user->password = '';
        // $user->remember = false;
        
        try{
            $input = Input::all();
            if ($input) {
                $user->email = $input['email'];
                $user->password = $input['password'];
                // $user->remember = $input['remember'];
                
                // authenticate a user
                if (isset($input['remember']) && $input['remember']) {
                    $user = Sentry::authenticateAndRemember(array(
                        'email'     => $user->email,
                        'password'  => $user->password
                    ));
                } else {
                    $user = Sentry::authenticate(array(
                        'email'     => $user->email,
                        'password'  => $user->password
                    ), FALSE);
                } 

                Session::put('welcome', 'Welcome! Click "Add" above to add a link to your page.');
                return Redirect::action('LinkController@index')->with('method', 'GET');
            } else {
                // return "02";                
                return View::make('home.signin')->with('user', $user);
            }
        } catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
            $errorMessage = 'Email field is required.';
        } catch (Cartalyst\Sentry\Users\PasswordRequiredException $e) {
            $errorMessage = 'Password field is required.';
        } catch (Cartalyst\Sentry\Users\WrongPasswordException $e) {
            $errorMessage = 'Wrong password, try again.';
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            $errorMessage = 'User was not found';
        } catch (Cartalyst\Sentry\Users\UserNotActivatedException $e) {
            $activated = false;
        } catch (Cartalyst\Sentry\Users\UserSuspendedException $e) {
            $errorMessage = 'User is suspended.';
        } catch (Cartalyst\Sentry\Users\UserBannedException $e) {
            $errorMessage = 'User is banned.';
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();//'User name and password is not correct.';
        }
        // return "03";
        Session::put('error', $errorMessage);
        return View::make('home.signin')->with('user', $user);
    }
    
    public function signup() {
        $errorMessage = 'Failed in signup';
        
        /*
        $user = array(
            'email'     => '',
            'password'  => ''
        );
        */
        
        $user = new User();
        // $user->email = Input::get('email');
         
        try {
            $input = Input::all();
            if ($input) {
                $user->email = $input['email'];
                $user->password = $input['password'];
                
                // register a user
                $user = Sentry::register(array(
                    'email'     => $user->email,
                    'password'  => $user->password,
                    'activated' => true
                ));
                // $activationCode = $user->getActivationCode();
                // $user->addGroup(Sentry::findGroupByName('Manager'));
                $user->addGroup(Sentry::findGroupByName('Client'));
                $user->save();
                
                Sentry::loginAndRemember($user);
                Session::put('welcome', 'Welcome! Click "+ Add" above to add a link to your page.');
                return Redirect::action('LinkController@index')->with('method', 'GET');
            } else {
                return View::make('home.signup')->with('user', $user);
            }
        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            $errorMessage = 'Login field is required.';
        }
        catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
        {
            $errorMessage = 'Password field is required.';
        }
        catch (Cartalyst\Sentry\Users\UserExistsException $e)
        {
            $errorMessage = 'User with this login already exists.';
        }
        catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
        {
            $errorMessage = 'Group was not found.';
        }
        Session::put('error', $errorMessage);
        return View::make('home.signup')->with('user', $user);        
    }

    public function signout() {
        Sentry::logout();
        
        // remove items from cache
        Cache::forget('feed_url');
        Cache::forget('articles');
        
        return Redirect::to('/');
    }
    
    public function forgotPassword() {
        return View::make('home.forgotPassword');
    }
    
    public function requestResetPassword() {
        try {
            $input = Input::all();
            $email = $input['email'];
            $user = Sentry::findUserByLogin($email);
            if ($user && $user->id >0 ) {
                $resetCode = $user->getResetPasswordCode();
                
                // send an email to user's mail box
                $subject = 'Your password reset code';
                $message = 'Code: '.$resetCode;
                if (!mail($email, $subject, $message, $headers)) {
                    throw new Exception('Email could not be sent'); 
                }
                Session::put('success', "The Reset Code has been sent to your email. Please check your Spam/Junk folder if you don't see an email from XXXX.");
                return Redirect::to('resetPassword')->with('method', 'GET');
            } else {
                throw new Exception('User does not exist');
            }
        } catch (\Exception $e) {
             Session::put('error', $e->getMessage());
             return Redirect::to('forgotPassword')->with('method', 'GET');
        }
    }
    
    public function resetPassword() {
        return View::make('home.resetPassword');
    }
    
    public function changePassword() {
        try {
            $input = Input::all();
            $email = $input['email'];
            $code = $input['code'];
            $password = $input['password'];
            $confirm_password = $input['confirm_password'];
            
            if ($password != $confirm_password) {
                throw new Exception('Confirm password does not match password');
            }
            
            $user = Sentry::findUserByLogin($email);
            if ($user && $user->id >0 ) {
                if ($user->checkResetPasswordCode($code)) {
                    if ($user->attemptResetPassword($code, $password)) {
                        Session::put('success', 'Password has been reset successfully');
                        return Redirect::to('signin')->with('method', 'GET');
                    } else {
                        throw new Exception('Password could not be reset');
                    }
                } else {
                    throw new Exception('Code is invalid');
                }
            } else {
                throw new Exception('User does not exist');
            }
        } catch (\Exception $e) {
            Session::put('error', $e->getMessage());
            return Redirect::to('resetPassword')->with('method', 'GET');
        }
    }

    public function terms() {
        return View::make('home.terms');
    }
    
    public function privacy() {
        return View::make('home.privacy');
    }
}
