@extends('admin.layout')

@section('header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Usuario</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item">
            <a href="{{ route('admin') }}">
                <i class="fas fa-tachometer-alt"></i>
                Inicio
            </a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{ route('admin.users.index') }}">Usuarios</a>
        </li>
        <li class="breadcrumb-item active">Posts</li>
      </ol>
    </div><!-- /.col -->
  </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-body card-profile">
                  <img class="profile-user-img img-responsive img-circle pull-center" src="/adminlte/img/user4-128x128.jpg" alt="{{ $user->name }}">
    
                  <h3 class="profile-username text-center">{{ $user->name }}</h3>
    
                  <p class="text-muted text-center">{{ $user->getRoleNames()->implode(', ') }}</p>
    
                  <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Email</b> <a class="float-right">{{ $user->email }}</a>
                    </li>
                    <li class="list-group-item">
                      <b>Publicaciones</b> <a class="float-right">{{ $user->posts->count() }}</a>
                    </li>
                    <li class="list-group-item">
                        @if( $user->roles->count())
                           <b>Roles</b> <a class="float-right">{{ $user->getRoleNames()->implode(', ') }}</a>
                        @endif
                    </li>
                  </ul>
    
                  <a href="{{{ route('admin.users.edit', $user )}}}" class="btn btn-primary btn-block"><b>Editar </b></a>
                </div>
                <!-- /.card-body -->
              </div>
        </div>
        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-header">
                   <h3 class="card-title">Publicaciones</h3>
                </div>
                <div class="card-body">
                    @forelse ($user->posts  as $post)
                        <a href="{{ route('posts.show', $post) }}" target="_blank">                        
                            <strong>{{ $post->title }}</strong><br>
                        </a>
                        <small class="text-muted">Publicado el {{ $post->published_at->format('d/m/Y')}}</small>
                        <p class="text-muted">{{ $post->excerpt }}</p>
                        @unless ($loop->last)
                        <hr>
                        @endunless
                    @empty    
                        <small class="text-muted">No tiene publicaciones.</small>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-header">
                   <h3 class="card-title">Roles</h3>
                </div>
                <div class="card-body">
                    @forelse ($user->roles  as $role)
                        <strong>{{ $role->name }}</strong>
                        @if($role->permissions->count())
                            <br>
                            <small class="text-muted">Permisos: {{ $role->permissions->pluck('name')->implode(', ') }}</small>
                        @endif  
                        @unless ($loop->last)
                        <hr>
                        @endunless
                    @empty
                        <small class="text-muted">No tiene ningun rol asociado.</small>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-header">
                   <h3 class="card-title">Permisos adicionales</h3>
                </div>
                <div class="card-body">
                    @forelse ($user->permissions  as $permission)
                        <strong>{{ $permission->name }}</strong>
                        @if($permission->permissions->count())
                            <br>
                            <small class="text-muted">Permisos: {{ $permission->permissions->pluck('name')->implode(', ') }}</small>
                        @endif  
                        @unless ($loop->last)
                        <hr>
                        @endunless
                    @empty
                        <small class="text-muted">No tiene permisos adicionales.</small>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
