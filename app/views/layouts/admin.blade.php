<!DOCTYPE html>
<html>
<head>
	<title>{{ $title }}</title>
	{{ HTML::style('//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css') }}
	{{ HTML::style(URL::to('css/admin.css')) }}
	{{ HTML::script('//code.jquery.com/jquery-1.11.0.min.js') }}
	{{ HTML::script('//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js') }}
</head>
<body>

	@include('common.admin_navbar')

		<div class="container">

			@if(Session::has('message'))
				{{ Alert::success(Session::get('message')) }}
			@endif

			@yield('content')
		</div>

</body>
</html>