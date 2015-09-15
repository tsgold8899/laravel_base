@extends('layouts.admin')

@section('content')
	<h1>Editing training region:</h1>

	@include('common.crud_errors')

	{{ Form::model($region, array('route'=>array('regions.update', $region->id), 'method'=>'PUT')) }}

		<p>
			{{ Form::label('name', 'Region name:') }} <br/>
			{{ Form::text('name') }}
		</p>

		<p>
			{{ Form::label('notes', 'Notes:') }} <br/>
			{{ Form::text('notes') }}
		</p>

		<p class="text-center"> {{ Form::submit('Edit region', array('class'=>'btn-success')) }} </p>

	{{ Form::close() }}
@endsection