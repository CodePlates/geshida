<div class="form-group">
	<label for="{{ $field }}">{{ field_label($datatype, $field) }}</label>
	<select class="form-control" name="{{ $field }}">
		@foreach($datatype->getField($field)->getOptions($relationshipData) as $key => $value)
			@php
				$dv = $dataItem->{$field};
				if (is_object($dv)) 
					$dv = $dataItem->{$field.'_id'};
			@endphp
			<option value="{{ $key }}" {{ old($field, $dv) == $key ? 'selected' : '' }}>{{ $value->displayName }}</option>			
		@endforeach
	</select>
</div>