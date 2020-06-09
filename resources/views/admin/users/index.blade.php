@extends('admin.layout')

@section('header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Usuarios</h1>
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
              <h3 class="card-title">Lista de Usuarios</h3>
              @can('create', $users->first())
                <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-primary float-right"><i class="fa fa-plus" aria-hidden="true">&nbsp;</i> Nueva Usurio</a>
              @endcan 
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Email</th>
                  <th>Rol</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                 
                <tbody> 
                    @foreach($users as $user)
                    {{-- eliminando query scope userscontroller allowed --}}
                      @can('view', $user)
                      <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->getRoleNames()->implode(', ') }}</td>
                        <td>
                            @can('view', $user)
                              <a href="{{ route('admin.users.show', $user) }}" class="btn btn-xs btn-success" title="ver"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            @endcan

                            @can('update', $user)
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-xs btn-primary" title="editar"><i class="fas fa-edit" aria-hidden="true"></i></a>
                            @endcan

                            @can('delete')
                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" style="display: inline">
                              @csrf {{ method_field('DELETE') }}
                              <button href="#" class="btn btn-xs btn-danger"
                              onclick="return confirm('¿Está seguro que desea eliminar este usuario. ?')"  
                              title="eliminar"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            </form>
                            @endcan
                        </td>
                      </tr>
                      @endcan
                    @endforeach
                </tbody>
              </table>
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

@push('styles')
<!-- DataTables -->
<link rel="stylesheet" href="/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
@endpush

@push('scripts')
<!-- DataTables -->
<script src="/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
    $(function () {
      $('#example1').DataTable({
        responsive: true,
        autoWidth: false,
        // "paging": true,
        // "lengthChange": true,
        // "searching": true,
        // "ordering": true,
        // "info": true,
        // "autoWidth": true,
      });
    });
</script>

@endpush

