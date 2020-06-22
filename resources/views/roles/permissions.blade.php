<h2>Permissions</h2>
<div class="row">
	@foreach($permissions as $name => $groupPerms)
		<div class="col-md-3">
			<h4>{{ ucfirst($name) }}</h4>					
				@foreach($groupPerms as $permission)
				{{-- We will deal with old() later --}}
				<div class="form-check">
				  <input class="form-check-input" 
				  		type="checkbox" value="{{ $permission->name }}" 
				  		id="permissions.{{ $permission->name }}" 
				  		name="permissions[]"
						{{ $dataItem->permissions->contains($permission) ? 'checked' : ''  }}
				  		>
				  <label class="form-check-label" for="permissions.{{ $permission->name }}">
				    {{ $permission->name }}
				  </label>
				</div>
				@endforeach
		</div>
	@endforeach
</div>