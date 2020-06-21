<div class="form-group">
	<label for="{{ $fieldName }}">{{ field_label($datatype, $field) }}</label>
	<select class="form-control" name="{{ $fieldName }}">
		<option value=""></option>
		@foreach($field->getOptions($relationshipData) as $key => $value)
			@php
				$dv = $dataItem->{$fieldName};
				if (is_object($dv)) 
					$dv = $dataItem->{$fieldName.'_id'};
			@endphp
			<option value="{{ $key }}" {{ old($fieldName, $dv) == $key ? 'selected' : '' }}>{{ $value->displayName }}</option>			
		@endforeach
	</select>
</div>