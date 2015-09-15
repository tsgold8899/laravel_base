<?php

class EmailController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('emails.index')
			->with('title', 'Email templates')				
			->with('emails', Email::orderBy('id')->get());
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('emails.create')
			->with('title', 'New email template');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validation = Email::validate(Input::all());
		if ($validation->fails()) {
			return Redirect::to('emails/create')
				->withErrors($validation)
				->withInput();
		} else {
			Email::create(Input::all());
			return Redirect::to('emails')->with('message', 'Email template created successfully.');
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
		return View::make('emails.show')
			->with('title', 'Email template details')
			->with('email', Email::find($id));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View::make('emails.edit')
			->with('title', 'Edit email template')
			->with('email', Email::find($id));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validation = Email::validate(Input::all());
		if ($validation->fails()) {
			return Redirect::to('emails/' . $id . '/edit')
				->withErrors($validation)
				->withInput();
		} else {
			$email = Email::find($id);
			$email->update(Input::all());
			$email->save();
			return Redirect::to('emails')->with('message', 'Email template updated successfully.');
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$email = Email::find($id);
		$email->delete();
		return Redirect::to('emails')->with('message', 'Email template successfully deleted');
	}


}
