<?php

class VenueController extends BaseController {

	
	// list venues
	public function index() {
		return View::make('venues.index')
			->with('title', 'Training Venues')					// give the page a title
			->with('venues', Venue::orderBy('id')->get());		// send the venues to the view
	}

	// show venue details
	public function show($id) {
		return View::make('venues.show')
			->with('title', 'View Venue')
			->with('venue', Venue::find($id));
	}

	// display creation form
	public function create() {
		return View::make('venues.create')
			->with('regions', Region::lists('name', 'id'))
			->with('title', 'Create venue');
	}

	// edit existing
	public function edit($id) {
		return View::make('venues.edit')
			->with('title', 'Edit venue')
			->with('regions', Region::lists('name', 'id'))
			->with('venue', Venue::find($id));
	}

	// delete existing
	public function destroy($id) {
		$venue = Venue::find($id);
		$venue->delete();
		return Redirect::to('venues')->with('message', 'Venue successfully deleted');
	}

	// handle a new submission
	public function store() {
		$validation = Venue::validate(Input::all());
		if ($validation->fails()) {
			return Redirect::to('venues/create')
				->withErrors($validation)
				->withInput();
		} else {
			Venue::create(Input::all());
			return Redirect::to('venues')->with('message', 'Venue created successfully.');
		}
	}

	// update an existing id
	public function update($id) {
		$validation = Venue::validate(Input::all());
		if ($validation->fails()) {
			return Redirect::to('venues/' . $id . '/edit')
				->withErrors($validation)
				->withInput();
		} else {
			$venue = Venue::find($id);
			$venue->update(Input::all());
			$venue->save();
			return Redirect::to('venues')->with('message', 'Venue updated successfully.');
		}
	}
}