<div class="sidebar">
	<ul class="sidebar-nav">
		@foreach ($virtualHosts as $host)
			<li><a href="#">{{$host}}</a></li>
		@endforeach
	</ul>
</div>