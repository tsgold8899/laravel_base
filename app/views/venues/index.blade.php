@extends('layouts.admin')

@section('content')
	<h1>Training Venues</h1>
	<p>Use this area to define venues in which training courses are held.</p><p>Special notes will be emailed to participants upon enrolment.</p><br />
	@include('venues.table')
	<p class="text-center">{{ Button::success_link('venues/create', 'Create new training venue') }} </p>
@endsection