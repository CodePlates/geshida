@extends('layouts.backend')

@section('content')

<div class="container">
	<h1>{{ __($dataKey.'.title_index') }}</h1>

	<table class="table table-bordered">
		<thead>
			@foreach($fields as $field)
				<th>{{ __("{$dataKey}.{$field}") }}</th>
			@endforeach
			<th>Actions</th>
		</thead>
		<tbody>
			@foreach($dataItems as $dataItem)
				<tr>
					@foreach($fields as $field)
						<td>{{ $dataItem->{$field} }}</td>
					@endforeach
					<td>
						<a href="{{ route($dataKey.".edit",[$dataItem]) }}" class="btn btn-primary">
							<i class="fa fa-pencil"></i>
							<span>Edit</span>
						</a>
						<form style="display: inline;" action="{{ route($dataKey.".destroy",[$dataItem]) }}" method="POST">
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