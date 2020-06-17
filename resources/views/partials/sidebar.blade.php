<div id="app-sidebar" class="sidebar py-3 px-2 bg-dark text-light">
	<h2>GeshCMS</h2>
	<ul class="nav flex-column">
		<li class="nav-item">
			<a class="nav-link active" href="{{ url('/') }}">Dashboard</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="{{ route('posts.index') }}">Posts</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="#">Link</a>
		</li>
		<li class="nav-item">
			<a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
		</li>
	</ul>
</div>