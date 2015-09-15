@extends('layouts.admin')

@section('content')
	<h1>Course regions</h1>
	<p>Use this area to create regions</p>
	<br />

		<table class="table table-striped">
			<thead>
				<tr>
					<td>Region name</td>
					<td>Notes</td>
				</tr>
			</thead>
			<tbody>
				@foreach($regions as $region)
					<tr>
						<td>{{ link_to_route('regions.show', $region->name, array($region->id)) }}</td>
						<td>{{ str_limit($region->notes, $limit = 100, $end = '...') }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>


	<p class="text-center">{{ Button::success_link('regions/create', 'Create new region') }} </p>
@endsection