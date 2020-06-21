<div class="form-group">
	<label for="{{ $fieldName }}">{{ field_label($datatype, $field) }}</label>
	<input type="text" class="form-control" name="{{ $fieldName }}" value="{{ old($fieldName, $field->getValue($dataItem)) }}">
</div>