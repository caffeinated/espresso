<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Date / Time</th>
			<th>Severity</th>
			<th>Message</th>
		</tr>
	</thead>

	<tbody>
		@foreach ($errorLog as $error)
			<tr>
				<td>{{ $error->date }}</td>
				<td><span class="label label-danger">{{ $error->severity }}</span></td>
				<td>{{ $error->message }}</td>
			</tr>
		@endforeach
	</tbody>
</table>