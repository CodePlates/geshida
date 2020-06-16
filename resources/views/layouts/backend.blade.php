<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Geshida Backend</title>
	<link rel="stylesheet" href="{{ asset('css/backend.css') }}">
</head>
<body>
	<div class="app-container sidebar-fixed topbar-fixed">
		@include('partials.topbar')

		<div class="app-body">
			@include('partials.sidebar')

			<main class="app-content">
				@yield('content')
			</main>
		</div>
	</div>

	<script src="{{ asset('js/backend.js') }}" defer></script>
</body>
</html>