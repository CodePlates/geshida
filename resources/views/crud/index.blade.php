@extends('layouts.backend')

@section('content')

<div class="container">
	<div class="row mr-0">
		<h1 class="col">{{ label($datatype, 'title_index') }}</h1>
		<div class="createbtn d-flex align-items-center">
			<a href="{{ crud_route('create', $model) }}" class="btn btn-primary">
				{{ label($datatype, 'create') }}
			</a>
		</div>
	</div>

	<table class="table table-bordered">
		<thead>
			@foreach($fields as $field)
				<th>{{ field_label($datatype, $field) }}</th>
			@endforeach
			<th>Actions</th>
		</thead>
		<tbody>
			@foreach($dataItems as $dataItem)
				<tr>
					@foreach($fields as $field)
						<td>{{ $datatype->getField($field)->browseDisplay($dataItem) }}</td>
					@endforeach
					<td>
						<a href="{{ crud_route("edit", $dataItem) }}" class="btn btn-primary">
							<i class="fa fa-pencil"></i>
							<span>Edit</span>
						</a>
						<form style="display: inline;" action="{{ crud_route("destroy", $dataItem) }}" method="POST">
							@csrf
							@method('DELETE')
							<button type="submit" class="btn btn-danger">
								<i class="fa fa-trash"></i>
								<span>Delete</span>
							</button>
						</form>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>

@endsection