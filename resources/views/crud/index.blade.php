@extends('layouts.backend')

@section('content')

<div class="container">
	<h1>{{ __($dataKey.'.title_index') }}</h1>

	<table class="table table-bordered">
		<thead>
			@foreach($fields as $field)
				<th>{{ __("{$dataKey}.{$field}") }}</th>
			@endforeach
		</thead>
		<tbody>
			@foreach($dataItems as $dataItem)
				<tr>
					@foreach($fields as $field)
						<td>{{ $dataItem->{$field} }}</td>
					@endforeach
				</tr>
			@endforeach
		</tbody>
	</table>
</div>

@endsection