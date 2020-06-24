<div id="app-sidebar" class="sidebar py-3 px-2 bg-dark text-light">
	<h2>GeshCMS</h2>
	<ul class="nav flex-column">
		<li class="nav-item">
			<a class="nav-link active" href="{{ url('/') }}">Dashboard</a>
		</li>
		@foreach($cruds as $crud)
			@can('viewAny', $crud['model'])
			<li class="nav-item">
				<a class="nav-link" href="{{ crud_route('index', $crud['model']) }}">
					{{ label($crud['model']::getDataType(), 'title_index') }}
				</a>
			</li>
			@endcan
		@endforeach
	</ul>
</div>