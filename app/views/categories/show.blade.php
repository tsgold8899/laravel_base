@extends('layouts.admin')

@section('content')
	<h1>Category details:</h1>
	<h3>{{ $category->name }}</h3>
	<p><b>Description:</b><br /> {{ $category->description }}</p>
	
	@if($category->imageURL)
		<p><b>Image:</b><br /> {{ $category->imageURL }}</p>
	@endif

	<p><b>Created at:</b><br /> {{ $category->created_at }}</p>
	<p><b>Updated at:</b><br /> {{ $category->updated_at }}</p>

	{{ Form::open(array('url' => 'categories/' . $category->id, 'method' => 'DELETE')) }}
		<p class="text-center">
			{{ Button::link_warning('categories/' . $category->id . '/edit', 'Edit category') }}
			{{ Form::submit('Delete category', array('class' => 'btn btn-danger')) }}
		</p>
	{{ Form::close() }}

@endsection