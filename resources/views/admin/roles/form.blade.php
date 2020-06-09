@csrf
<div class="form-group">
    <label for="name">Identificador:</label>
    @if($role->exists)
        <input class="form-control" type="text" value="{{ $role->name }}" disabled>
    @else
        <input name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" value="{{ old('name', $role->name) }}">
    @endif
</div>

<div class="form-group">
  <label for="display_name">Nombre:</label>
  <input class="form-control {{ $errors->has('display_name') ? 'is-invalid' : '' }}" type="text" value="{{ old('display_name', $role->display_name) }}" name="display_name">
</div>

{{-- {{-- <div class="form-group"> --}}
    {{-- <label for="email">Guard:</label> --}}
    {{-- <input class="form-control {{ $errors->has('guard_name') ? 'is-invalid' : '' }}" type="text" value="{{ old('guard_name') }}" name="guard_name"> --}}
    {{-- <select class="form-control" name="guard_name" id=""> --}}
        {{-- @foreach(config('auth.guards') as $guardName => $guard) --}}
            {{-- <option {{ old('guard_name', $role->guard_name) === $guardName ? 'selected' : '' }} value="{{ $guardName }}">{{ $guardName }}</option> --}}
        {{-- @endforeach --}}
    {{-- </select> --}}
{{-- </div> --}}

<div class="row">
    <div class="form-group col-md-6">
        <label for="">Permisos</label>
        @include('admin.users.partials.check_permissions', ['model' =>  $role])
    </div>
</div>