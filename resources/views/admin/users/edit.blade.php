@extends('admin.layout')    

@section('header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Crear Usuario</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
        <li class="breadcrumb-item active">Usuarios</li>
      </ol>
    </div><!-- /.col -->
  </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Datos Personales</h3>
                </div>
                <div class="card-body">
                    
                    @include('partials.error-messages')
                    
                    <form  method="POST" action="{{ route('admin.users.update', $user) }}">
                    @csrf @method('PUT')
                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" value="{{ old('name', $user->name) }}" name="name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" value="{{ old('email', $user->email) }}" name="email">
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña:</label>
                            <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" placeholder="Contraseña">
                            <span class="help-block">
                                <small class="text-muted">
                                    Dejar vacio si no desea cambiar la contraseña.
                                </small>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Repetir Contraseña:</label>
                            <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"  name="password_confirmation" placeholder="Repetir Contraseña">
                        </div>
                        <button class="btn btn-primary btn-block">Actualizar Usuario</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Roles</h3>
                </div>
                <div class="card-body">
                    @role('Admin')
                    <form action="{{ route('admin.users.roles.update', $user )}}" method="POST">
                    @method('PUT') @csrf
                        
                    @include('admin.users.partials.check_roles')    
                    
                    <button class="btn btn-primary btn-block">Actualizar Roles</button>
                    </form>
                    @else
                        <ul class="list-group">
                            @forelse($user->roles as $role)
                                <li class="list-group-item">{{ $role->name }}</li>
                            @empty    
                                <li class="list-group-item">No tiene roles asignados.</li>
                            @endforelse
                        </ul>                      
                    @endrole
                </div>
            </div>
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Permisos</h3>
                </div>
                <div class="card-body">
                    @role('Admin')
                    <form action="{{ route('admin.users.permissions.update', $user )}}" method="POST">
                    @method('PUT') @csrf
                        
                    @include('admin.users.partials.check_permissions', ['model' => $user])    
                        
                    <button class="btn btn-primary btn-block">Actualizar Permisos</button>
                    </form>
                    @else
                    <ul class="list-group">
                        @forelse($user->permissions as $permission)
                            <li class="list-group-item">{{ $permission->name }}</li>
                        @empty    
                            <li class="list-group-item">No tiene permisos asignados.</li>
                        @endforelse
                    </ul> 
                    @endrole
                </div>
            </div>
        </div>
    </div>
</section>
@endsection