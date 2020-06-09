<div class="form-group">
    @foreach ($roles as $role)
    <div class="custom-control custom-checkbox">
        <input name="roles[]" id="check_role_{{ $role->id }}" class="custom-control-input" type="checkbox" value="{{ $role->id }}" 
            {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
        <label for="check_role_{{ $role->id }}" class="custom-control-label">{{ $role->name }}</label>
        <br>
        <small class="text-muted">{{ $role->permissions->pluck('name')->implode(' - ') }}</small>
    </div>
    @endforeach
</div>