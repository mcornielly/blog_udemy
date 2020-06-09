<div class="form-group">
    @foreach ($permissions as $id => $name)
    <div class="custom-control custom-checkbox">
        <input name="permissions[]" id="check_permission_{{ $id }}" class="custom-control-input" type="checkbox" value="{{ $id }}" 
            {{-- {{ collect(old('permissions'))->contains($name) ? 'checked' : ''}} --}}
            {{ $model->permissions->contains($id) || collect(old('permissions'))->contains($id) ? 'checked' : '' }}>
        <label for="check_permission_{{ $id }}" class="custom-control-label">{{ $name }}</label>
    </div>
    @endforeach
</div>