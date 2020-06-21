<div class="form-group">
	<label for="{{ $fieldName }}">{{ field_label($datatype, $field) }}</label>
	<select class="form-control" name="{{ $fieldName }}">
		<option value=""></option>
		@foreach($field->getOptions($relationshipData) as $key => $option)			
			<option value="{{ $key }}" {{ old($fieldName, $field->getValue($dataItem)) == $key ? 'selected' : '' }}>{{ $option->displayName }}</option>			
		@endforeach
	</select>
</div>