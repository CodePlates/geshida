<div class="form-group">
	<label for="{{ $field }}">{{ field_label($datatype, $field) }}</label>
	<input type="text" class="form-control" name="{{ $field }}" value="{{ old($field, $dataItem->{$field}) }}">
</div>