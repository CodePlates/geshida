@extends('layouts.backend')

@section('content')
<div class="container">
	<h1>{{ __($dataKey.'.title_edit') }}</h1>

	<form action="{{ route($dataKey.".update",[$dataItem]) }}" method="post">
		@method('PUT')
		@csrf		
		
		@foreach($fields as $field)	
			@includeFirst(['formfields.'.$datatype->getFormField($field), 'formfields.text'])	
		@endforeach

		<div class="buttons">
			<button class="btn btn-primary">{{ __($dataKey.'.update') }}</button>
		</div>

	</form>
</div>
@endsection