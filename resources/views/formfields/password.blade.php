<div class="form-group">
	<label for="{{ $fieldName }}">{{ field_label($datatype, $field) }}</label>
	<input type="password" class="form-control" name="{{ $fieldName }}" value="{{ old($fieldName) }}">
</div>