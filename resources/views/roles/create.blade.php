@extends('layouts.backend')

@section('content')
<div class="container">
	<h1>{{ label($datatype, 'title_create') }}</h1>

	<form action="{{ crud_route("store", $model) }}" method="post" @if($fields->hasFileFields()) enctype="multipart/form-data" @endif>
		@csrf		
		
		@foreach($fields as $fieldName => $field)	
			@includeFirst(['formfields.'.$field->getFormField(), 'formfields.text'])	
		@endforeach

		@include('roles.permissions')

		<div class="buttons">
			<button class="btn btn-primary">{{ label($datatype, 'store') }}</button>
		</div>

	</form>
</div>
@endsection