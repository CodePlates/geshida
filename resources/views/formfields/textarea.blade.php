<div class="form-group">
	<label for="{{ $fieldName }}">{{ field_label($datatype, $field) }}</label>
	<textarea class="form-control" name="{{ $fieldName }}">{{ old($fieldName, $dataItem->{$fieldName}) }}</textarea>
</div>