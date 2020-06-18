<div class="form-group">
	<label for="{{ $field }}">{{ __("{$dataKey}.{$field}") }}</label>
	<input type="text" class="form-control" name="{{ $field }}" value="{{ old($field, $dataItem->{$field}) }}">
</div>