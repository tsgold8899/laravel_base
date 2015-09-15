@extends('layouts.admin')

@section('content')
	<h1>Training venue details:</h1>
	<h3>{{ $venue->name }}</h3>
	<p><b>Address:</b><br /> {{ $venue->address }}</p>

	<p><b>Region:</b><br /> {{ $venue->region->name or 'None selected' }}</p>
	
	@if($venue->notes)
		<p><b>Notes:</b><br /> {{ $venue->notes }}</p>
	@endif

	<p><b>Created at:</b><br /> {{ $venue->created_at }}</p>
	<p><b>Updated at:</b><br /> {{ $venue->updated_at }}</p>

	{{ Form::open(array('url' => 'venues/' . $venue->id, 'method' => 'DELETE')) }}
		<p class="text-center">
			{{ Button::link_warning('venues/' . $venue->id . '/edit', 'Edit venue') }}
			{{ Form::submit('Delete venue', array('class' => 'btn btn-danger')) }}
		</p>
	{{ Form::close() }}

@endsection