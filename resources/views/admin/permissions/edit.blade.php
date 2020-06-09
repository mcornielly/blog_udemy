@extends('admin.layout')

@section('header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Editrar Permiso</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}"></a></li>
        <li class="breadcrumb-item active">Editar Permiso</li>
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
              <h3 class="card-title">Editar Permiso</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                @include('partials.error-messages')

                <form method="POST" action="{{ route('admin.permissions.update', $permission->id) }}">
                    @method('PUT')
                    @csrf

                    <div class="form-group">
                        <label for="name">Identificador:</label>
                        <input class="form-control" type="text" value="{{ $permission->name }}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="display_name">Nombre:</label>
                        <input class="form-control {{ $errors->has('display_name') ? 'is-invalid' : '' }}" type="text" value="{{ old('display_name', $permission->display_name) }}" name="display_name">
                    </div>

                    <button class="btn btn-primary btn-block">Actualizar Permiso</button>
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
