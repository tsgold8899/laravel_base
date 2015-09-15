@extends('layouts.admin')

@section('content')
	<h1>Editing course category:</h1>

	@include('common.category_errors')

	{{ Form::model($category, array('route'=>array('categories.update', $category->id), 'method'=>'PUT')) }}

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


		<p class="text-center"> {{ Form::submit('Edit category', array('class'=>'btn-success')) }} </p>

	{{ Form::close() }}
@endsection