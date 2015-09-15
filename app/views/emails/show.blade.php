@extends('layouts.admin')

@section('content')
	<h1>Email template details:</h1>
	<h3>{{ $email->name }}</h3>
	
	<p><b>Subject line:</b><br /> {{ $email->subject }}</p>
	<p><b>Email content:</b><br /> <pre>{{ $email->content }}</pre></p>
	
	@if($email->notes)
		<p><b>Notes:</b><br /> {{ $email->notes }}</p>
	@endif

	<p><b>Created at:</b><br /> {{ $email->created_at }}</p>
	<p><b>Updated at:</b><br /> {{ $email->updated_at }}</p>

	{{ Form::open(array('url' => 'emails/' . $email->id, 'method' => 'DELETE')) }}
		<p class="text-center">
			{{ Button::link_warning('emails/' . $email->id . '/edit', 'Edit email template') }}
			{{ Form::submit('Delete email template', array('class' => 'btn btn-danger')) }}
		</p>
	{{ Form::close() }}

@endsection