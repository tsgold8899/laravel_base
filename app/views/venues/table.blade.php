<table class="table table-striped">
	<thead>
		<tr>
			<td>Venue name</td>
			<td>Address</td>
			<td>Region</td>
			<td>Special notes</td>
		</tr>
	</thead>
	<tbody>
		@foreach($venues as $venue)
			<tr>
				<td>{{ link_to_route('venues.show', $venue->name, array($venue->id)) }}</td>
				<td>{{ $venue->address }}</td>
				<td>{{ $venue->region->name or 'None selected' }}</td>
				<td>{{ str_limit($venue->notes, $limit = 40, $end = '...') }}</td>
			</tr>
		@endforeach
	</tbody>
</table>