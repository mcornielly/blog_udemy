@extends('admin.layout')

@section('header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Editrar Rol</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Roles</a></li>
        <li class="breadcrumb-item active">Editar Rol</li>
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
              <h3 class="card-title">Editar Rol</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                @include('partials.error-messages')

                <form method="POST" action="{{ route('admin.roles.update', $role->id) }}">
                     @method('PUT')

                     @include('admin.roles.form')
                    
                    <button class="btn btn-primary btn-block">Actualizar Rol</button>
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
