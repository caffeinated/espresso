@extends('layouts.master')

@section('content')
	<div class="col-md-12">
		<h2>Error Log</h2>
		<div id="errorlog">
			<h2 class="text-center"><i class="fa fa-refresh fa-spin"></i></h2>
			<p class="text-center"><small>Loading</small></p>
		</div>
	</div>
@stop

@section('javascript')
	<script type="text/javascript">
		$(document).ready(function() {			
			setInterval(function() {
				$('#errorlog').load("{{ URL::to('apache/error-log/show') }}");
			}, 1000);
		});
	</script>
@stop