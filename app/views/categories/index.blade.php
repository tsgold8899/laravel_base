@extends('layouts.admin')

@section('content')
	<h1>Course categories</h1>
	<p>Use this area to define course categories</p><br />
	@include('categories.table')
	<p class="text-center">{{ Button::success_link('categories/create', 'Create new course category') }} </p>
@endsection