@extends('layouts.backend')

@section('content')
<div class="container">
	<h1>{{ label($datatype, 'title_edit') }}</h1>

	<form action="{{ crud_route("update", $dataItem) }}" method="post">
		@method('PUT')
		@csrf		
		
		@foreach($fields as $field)	
			@includeFirst(['formfields.'.$datatype->getFormField($field), 'formfields.text'])	
		@endforeach

		<div class="buttons">
			<button class="btn btn-primary">{{ label($datatype, 'update') }}</button>
		</div>

	</form>
</div>
@endsection