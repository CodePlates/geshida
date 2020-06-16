@extends('layouts.backend')

@section('content')
<h1>Listing</h1>

<ul>
	@foreach($dataItems as $dataItem)
	<li>{{ $dataItem->title }}</li>
	@endforeach
</ul>
<table class="table">

</table>

<div style="height: 400px; background-color: #040404; width: 100px; margin-bottom: 20px;"></div>

@endsection