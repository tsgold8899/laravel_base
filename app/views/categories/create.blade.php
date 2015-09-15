@extends('layouts.admin')

@section('content')
	<h1>Creating new course category</h1>
	<p>Enter the category details below. All details enetered are visible to the public</p>

	@include('common.category_errors')

	{{ Form::open(array('url'=>'categories', 'method'=>'POST')) }}

	<p>
		{{ Form::label('name', 'Category name:') }} <br/>
		{{ Form::text('name') }}
	</p>

	<p>
		{{ Form::label('description', 'Description:') }} <br/>
		{{ Form::text('description') }}
	</p>

	<p> 
		{{ Form::label('imageURL', 'Image URL:') }} <br/>
		{{ Form::text('imageURL') }}
	</p>

	<p class="text-center"> {{ Form::submit('Add category', array('class'=>'btn-success')) }} </p>

	{{ Form::close() }}
@endsection