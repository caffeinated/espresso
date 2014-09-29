@extends('layouts.master')

@section('content')
	<div class="col-md-8">
		<h1>Virtual Hosts</h1>

		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Host</th>
					<th width="50px"> </th>
				</tr>
			</thead>

			<tbody>
				@foreach ($virtualHosts as $host)
					<tr>
						<td><a href="http://{{ $host }}/" target="_blank">{{ $host }}</a></td>
						<td class="text-right"><a href="#" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i></a></td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>	
@stop