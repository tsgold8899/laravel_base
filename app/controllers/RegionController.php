<?php

class RegionController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('regions.index')
			->with('title', 'Course regions')
			->with('regions', Region::orderBy('id')->get());
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('regions.create')
			->with('title', 'Create region');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validation = Region::validate(Input::all());
		if ($validation->fails()) {
			return Redirect::to('regions/create')
				->withErrors($validation)
				->withInput();

		} else {

			Region::create(Input::all());

			return Redirect::to('regions')->with('message', 'Region created successfully.');

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
		return View::make('regions.show')
			->with('title', 'View region')
			->with('region', Region::find($id));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View::make('regions.edit')
			->with('title', 'Edit region')
			->with('region', Region::find($id));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validation = Region::validate(Input::all());

		if ($validation->fails()) {

			return Redirect::to('regions/' . $id . '/edit')
				->withErrors($validation)
				->withInput();

		} else {

			$region = Region::find($id);
			$region->update(Input::all());
			$region->save();

			return Redirect::to('regions')->with('message', 'Region updated successfully.');
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
		$region = Region::find($id);
		$region->delete();
		return Redirect::to('regions')->with('message', 'Region successfully deleted');

	}


}
