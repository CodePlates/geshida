@extends('layouts.backend')

@section('content')
<div class="container">
	<h1>{{ __($dataKey.'.title_create') }}</h1>

	<form action="{{ route($dataKey.".store",[$dataItem]) }}" method="post">
		@csrf		
		
		@foreach($fields as $field)	
			@includeFirst(['formfields.'.$datatype->getFieldType($field), 'formfields.text'])	
		@endforeach

		<div class="buttons">
			<button class="btn btn-primary">{{ __($dataKey.'.store') }}</button>
		</div>

	</form>
</div>
@endsection