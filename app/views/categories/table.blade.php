<table class="table table-striped">
	<thead>
		<tr>
			<td>Category name</td>
			<td>Description</td>
			<td>Image</td>
		</tr>
	</thead>
	<tbody>
		@foreach($categories as $category)
			<tr>
				<td>{{ link_to_route('categories.show', $category->name, array($category->id)) }}</td>
				<td>{{ $category->description }}</td>
				<td>{{ $category->imageURL }}</td>
			</tr>
		@endforeach
	</tbody>
</table>