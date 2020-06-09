@extends('admin.layout')

@section('header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Publicaciones</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
        <li class="breadcrumb-item active">Posts</li>
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
              <h3 class="card-title">Lista de Publicaciones</h3>
              <a href="#create" data-toggle="modal" data-target="#exampleModal" class="btn btn-sm btn-primary float-right"><i class="fa fa-plus" aria-hidden="true">&nbsp;</i> Nueva Publicación</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Título</th>
                  <th>Extracto</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                 
                <tbody> 
                    @foreach($posts as $post)     
                <tr>
                  <td>{{ $post->id }}</td>
                  <td>{{ $post->title }}</td>
                  <td>{{ $post->excerpt }}</td>
                  <td>
                      {{-- <a href="{{ route('posts.show', $post) }}" target="_blank" class="btn btn-xs btn-success" title="ver"><i class="fa fa-eye" aria-hidden="true"></i></a> --}}
                      <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-xs btn-primary" title="editar"><i class="fas fa-edit" aria-hidden="true"></i></a>

                      <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" style="display: inline">
                        @csrf {{ method_field('DELETE') }}
                        <button href="#" class="btn btn-xs btn-danger"
                        onclick="return confirm('¿Está seguro que desea eliminar esta publicación. ?')"  
                        title="eliminar"><i class="fa fa-trash" aria-hidden="true"></i></button>
                      </form>
                  </td>
                </tr>
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

