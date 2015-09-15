@extends('layouts.admin')

@section('content')
	<h1>Email templates</h1>
	<p>Templates defined here will be emailed to applicants upon successful enrolment.</p><br />
	@include('emails.table')
	<p class="text-center">{{ Button::success_link('emails/create', 'Create new email template') }} </p>
@endsection