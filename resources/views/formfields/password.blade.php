<div class="form-group">
	<label for="{{ $field }}">{{ field_label($datatype, $field) }}</label>
	<input type="password" class="form-control" name="{{ $field }}" value="{{ old($field) }}">
</div>