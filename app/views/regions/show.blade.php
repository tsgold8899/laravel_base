@extends('layouts.admin')

@section('content')
	<h1>Region details:</h1>
	<h3>{{ $region->name }}</h3>

	@if($region->notes)
		<p><b>Notes:</b><br /> {{ $region->notes }}</p>
	@endif

	<p><b>Created at:</b><br /> {{ $region->created_at }}</p>
	<p><b>Updated at:</b><br /> {{ $region->updated_at }}</p>

	<?php $venues = $region->venues ?>
	@if($venues->count()>0)
		<p><b>Venues in this region:</b></p>
		@include('venues.table')
	@endif

	{{ Form::open(array('url' => 'regions/' . $region->id, 'method' => 'DELETE')) }}
		<p class="text-center">
			{{ Button::link_warning('regions/' . $region->id . '/edit', 'Edit region') }}
			{{ Form::submit('Delete region', array('class' => 'btn btn-danger')) }}
		</p>
	{{ Form::close() }}

@endsection