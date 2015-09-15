<table class="table table-striped">
	<thead>
		<tr>
			<td>Template name</td>
			<td>Subject line</td>
			<td>Notes</td>
		</tr>
	</thead>
	<tbody>
		@foreach($emails as $email)
			<tr>
				<td>{{ link_to_route('emails.show', $email->name, array($email->id)) }}</td>
				<td>{{ $email->subject }}</td>
				<td>{{ $email->notes }}</td>
			</tr>
		@endforeach
	</tbody>
</table>