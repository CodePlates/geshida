@extends('layouts.backend')

@section('content')
<h1>Dashboard</h1>

@auth
<div class="d-flex justify-content-center p-3 bg-secondary" style="margin-top: 150px">
	<h2 class="text-center text-white ">Welcome back {{ Auth::user()->full_name }}</h2>
</div>
@endauth


@endsection