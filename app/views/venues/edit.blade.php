@extends('layouts.admin')

@section('content')
	<h1>Editing training venue:</h1>

	@include('common.crud_errors')

	{{ Form::model($venue, array('route'=>array('venues.update', $venue->id), 'method'=>'PUT')) }}

		<p>
			{{ Form::label('name', 'Venue name:') }} <br/>
			{{ Form::text('name') }}
		</p>

		<p>
			{{ Form::label('address', 'Address:') }} <br/>
			{{ Form::text('address') }}
		</p>

		<p> 
			{{ Form::label('region_id', 'Venue region:') }} <br/>
			{{ Form::select('region_id', $regions) }}
		</p>

		<p>
			{{ Form::label('notes', 'Special notes:') }} <br/>
			{{ Form::textarea('notes') }}
		</p>


		<p class="text-center"> {{ Form::submit('Edit venue', array('class'=>'btn-success')) }} </p>

	{{ Form::close() }}
@endsection