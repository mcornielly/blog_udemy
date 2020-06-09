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
      <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Nuevo Usuario</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                
                @include('partials.error-messages')

                <form method="POST" action="{{ route('admin.users.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nombre:</label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" value="{{ old('name') }}" name="name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" value="{{ old('email') }}" name="email">
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">Roles</label>
                            @include('admin.users.partials.check_roles')
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Permisos</label>
                            @include('admin.users.partials.check_permissions', ['model' => $user])
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block">Crear Usuario</button>
                </form>    
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
</section>  
@endsection
