<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin') }}" class="brand-link">
      <img src="/adminlte/img/ZenderoLogo.png" alt="Zendero Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/adminlte/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        @if(auth()->user())
        <div class="info">
          <a href="#" class="d-block">{{ auth()->user()->name }}</a>
        </div>
        @endif
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
            <a href="{{ route('admin') }}" class="nav-link {{ setActiveRoute('admin') }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
            </a>
            </li>
            {{-- @can('view', new App\Post) --}}
            <li class="nav-item has-treeview {{ request()->is('admin/posts*') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ setActiveRoute('admin.posts.index') }}">
                  <i class="nav-icon nav-icon fas fa-th"></i>
                  <p>
                    Blog
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                      {{-- <a href="{{ route('admin.posts.index') }}" class="nav-link {{ request()->is('admin/posts*') ? 'active' : '' }}"> --}}
                      <a href="{{ route('admin.posts.index') }}" class="nav-link {{ setActiveRoute(['admin.posts.index', 'admin.posts.create','admin.posts.edit']) }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Posts</p>
                    </a>
                  </li>
                </ul>
              </li>
              {{-- @endcan --}}

              @can('view', new App\User)
              <li class="nav-item">
                {{-- <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}"> --}}
                  <a href="{{ route('admin.users.index') }}" class="nav-link {{ setActiveRoute('admin.users.index') }}">
                    <i class="nav-icon fas fa-fw fa-users"></i>
                    <p>Usuarios</p>
                </a>
              </li>
              @else
              <li class="nav-item">
                <a href="{{ route('admin.users.show', auth()->user() ) }}" class="nav-link {{ setActiveRoute(['admin.users.show', 'admin.users.edit']) }}">
                    <i class="nav-icon fas fa-fw fa-user"></i>
                    <p>Perfil</p>
                </a>
              </li>
              @endcan

              @can('view', new \Spatie\Permission\Models\Role)
              <li class="nav-item">
                <a href="{{ route('admin.roles.index') }}" class="nav-link {{ setActiveRoute('admin.roles.index') }}">
                    <i class="nav-icon fas fa-fw fa-bars"></i>
                    <p>Roles</p>
                </a>
              </li>
              @endcan

              @can('view', new \Spatie\Permission\Models\Permission)
              <li class="nav-item">
                  {{-- <a href="{{ route('admin.permissions.index') }}" class="nav-link {{ request()->is('admin/permissions*') ? 'active' : '' }}"> --}}
                  <a href="{{ route('admin.permissions.index') }}" class="nav-link {{ setActiveRoute(['admin.permissions.index', 'admin.permissions.create', 'admin.permissions.edit']) }}">
                    <i class="nav-icon fas fa-bookmark"></i>
                    <p>Permisos</p>
                </a>
              </li>
              @endcan
          {{-- <li class="nav-item has-treeview menu-open">
            <a href="{{ route('admin.posts.index') }}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Starter Pages
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Active Page</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inactive Page</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Simple Link
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li> --}}
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>