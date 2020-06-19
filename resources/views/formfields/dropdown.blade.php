<div class="form-group">
	<label for="{{ $field }}">{{ field_label($datatype, $field) }}</label>
	<select class="form-control" name="{{ $field }}">
		@foreach($datatype->getField($field)->getOptions() as $key => $value)
			<option value="{{ $key }}">{{ $value }}</option>			
		@endforeach
	</select>
</div>