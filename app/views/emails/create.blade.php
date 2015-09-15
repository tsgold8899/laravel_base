@extends('layouts.admin')

@section('content')
	<h1>Editing email template:</h1>

	@include('common.crud_errors')

	<p><b>Automatic text replacement:</b></p>
	<p>Email templates will automatically make substitutions of the following key words</p>
	<p>
		<ul>
			<li>{firstname}</b> - the applicant's first name</li>
			<li>{lastname}</b> - the applicant's last name</li>
			<li>{participants}</b> - a list of participants enrolled in a course</li>
			<li>{totalprice}</b> - the total amount paid</li>
		</ul>
	</p>

	{{ Form::open(array('url'=>'emails', 'method'=>'POST')) }}

		<p>
			{{ Form::label('name', 'Email template name:') }} <br/>
			{{ Form::text('name') }}
		</p>

		<p>
			{{ Form::label('subject', 'Email subject line:') }} <br/>
			{{ Form::text('subject') }}
		</p>

		<p>
			{{ Form::label('content', 'Email content:') }} <br/>
			{{ Form::textarea('content') }}
		</p>

		<p>
			{{ Form::label('notes', 'Template notes (internal use only):') }} <br/>
			{{ Form::text('notes') }}
		</p>

		<p class="text-center"> {{ Form::submit('Add email', array('class'=>'btn-success')) }} </p>

	{{ Form::close() }}
	
@endsection