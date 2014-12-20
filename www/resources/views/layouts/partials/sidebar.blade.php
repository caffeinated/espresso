<div class="sidebar">
	<ul class="sidebar-nav">
		@foreach ($virtualHosts as $key => $host)
			<li><a href="/virtualhost/edit/{{ $key }}">{{ $host }}</a></li>
		@endforeach
	</ul>
</div>