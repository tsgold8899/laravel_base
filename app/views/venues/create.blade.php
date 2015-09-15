@extends('layouts.admin')

@section('content')
	<h1>Creating new training venue</h1>
	<p>Enter the venue details below. All details enetered are visible to the public</p>

	@include('common.crud_errors')

	{{ Form::open(array('url'=>'venues', 'method'=>'POST')) }}

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

	<p class="text-center"> {{ Form::submit('Add venue', array('class'=>'btn-success')) }} </p>

	{{ Form::close() }}
@endsection