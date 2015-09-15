@extends('layouts.admin')

@section('content')
	<h1>Creating new region</h1>
	<p>Enter the region details below. All details enetered are visible to the public.</p>

	@include('common.crud_errors')

	{{ Form::open(array('url'=>'regions', 'method'=>'POST')) }}

	<p>
		{{ Form::label('name', 'Region name:') }} <br/>
		{{ Form::text('name') }}
	</p>

	<p>
		{{ Form::label('notes', 'Notes:') }} <br/>
		{{ Form::text('notes') }}
	</p>

	<p class="text-center"> {{ Form::submit('Add region', array('class'=>'btn-success')) }} </p>

	{{ Form::close() }}
@endsection