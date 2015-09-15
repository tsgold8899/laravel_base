<?php

class CategoryController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('categories.index')
			->with('title', 'Course categories')				
			->with('categories', Category::orderBy('id')->get());	
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('categories.create')
			->with('title', 'Create category');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validation = Category::validate(Input::all());
		if ($validation->fails()) {
			return Redirect::to('categories/create')
				->withErrors($validation)
				->withInput();
		} else {
			Category::create(Input::all());
			return Redirect::to('categories')->with('message', 'Category created successfully.');
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
		return View::make('categories.show')
			->with('title', 'View category')
			->with('category', Category::find($id));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View::make('categories.edit')
			->with('title', 'Edit category')
			->with('category', Category::find($id));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validation = Category::validate(Input::all());
		if ($validation->fails()) {
			return Redirect::to('categories/' . $id . '/edit')
				->withErrors($validation)
				->withInput();
		} else {
			$cateory = Category::find($id);
			$cateory->update(Input::all());
			$cateory->save();
			return Redirect::to('categories')->with('message', 'Category updated successfully.');
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
		$category = Category::find($id);
		$category->delete();
		return Redirect::to('categories')->with('message', 'Category successfully deleted');
	}


}
