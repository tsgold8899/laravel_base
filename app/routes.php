<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*
Route::group(array('before' => 'auth'), function() {
    Route::get('/', function()
    {
        return View::make('auth/signin');
    });
});
*/
Route::get('terms', 'HomeController@terms');
Route::get('privacy', 'HomeController@privacy');

Route::group(array('before'=>'guest'), function() {
    Route::get('/', 'HomeController@home'); //->before('auth')
    Route::any('signin', 'HomeController@signin');
    Route::any('signup', 'HomeController@signup');
    Route::get('forgotPassword', 'HomeController@forgotPassword');
    Route::post('requestResetPassword', 'HomeController@requestResetPassword');    
    Route::get('resetPassword', 'HomeController@resetPassword');
    Route::post('changePassword', 'HomeController@changePassword');
});

Route::group(array('before'=>'auth'), function() {
    Route::get('signout', 'HomeController@signout');
    
    // Route::resource('home', 'BookmarkController');
    // Route::get('home/{id}/visiting', 'BookmarkController@visiting');
    // Route::post('home/installed', 'BookmarkController@installed');
    
    Route::get('link/{id}/visiting', 'LinkController@visiting');
    Route::post('link/installed', 'LinkController@installed');
    Route::resource('link', 'LinkController');
    
    Route::post('section/newSection', 'SectionController@newSection');
    Route::get('section/getSections', 'SectionController@getSections');
    Route::get('section/{section_id}/editLink/{id}', 'SectionController@editLink');
    Route::post('section/{section_id}/updateLink/{id}', 'SectionController@updateLink');
    Route::get('section/createLink', 'SectionController@createLink');
    Route::post('section/storeLink', 'SectionController@storeLink');
    Route::any('section/saveLinkOrder', 'SectionController@saveLinkOrder');
    Route::any('section/saveSectionOrder', 'SectionController@saveSectionOrder');
    Route::resource('section', 'SectionController');
    // Route::get('section/{id}/link', 'SectionController@createLink');
    
    Route::resource('user', 'UserController');
    Route::any('user/{id}/changeEmail', 'UserController@changeEmail');
    Route::any('user/{id}/changePassword', 'UserController@changePassword');
    Route::get('user/{id}/saveOption', 'UserController@saveOption');
});
