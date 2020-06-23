<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>

	<link rel="stylesheet" href="{{ asset('css/backend.css') }}">
</head>
<body style="background-color: #bdbdbd">
	<div class="container" style="margin-top: 100px;">
		<div class="row justify-content-center">
		<div class="col-md-5 col-sm-8">
			<div class="card">
			  <div class="card-header">
			    <h2>Geshida: Login</h2>
			  </div>
			  <div class="card-body">
			    <form action="{{ route('login') }}" method="post" class="loginform">
					@csrf

					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
					</div>

					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" class="form-control" id="password" name="password">
					</div>
					
					<div class="d-flex buttons">
						<button type="submit" class="btn btn-primary ml-auto px-4">Login</button>
					</div>
			    </form>
			  </div>
			</div>

		</div>
		</div>
	</div>

</body>
</html>