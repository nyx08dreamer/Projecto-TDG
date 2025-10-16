<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="../../index3.html" class="brand-link elevation-4">
    <img src="{{asset('assets/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">

    <!-- SidebarSearch Form -->
    <div class="form-inline mt-3 pt-3 mb-3">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column pb-3" data-widget="treeview" role="menu" data-accordion="false">
        
        <li class="nav-item">
          <a href="{{ route('home') }}" class="nav-link {{isRouteActive('home')}}">
            <i class="fa-solid fa-table-columns"></i>
            <p>
              DashBoard
            </p>
          </a>
        </li>

        <li class="nav-item {{isMenuOpen('gestion.')}}">
          <a href="#" class="nav-link {{isRouteActive('gestion.')}}">
            <i class="nav-icon fa fa-bolt"></i>
            <p>
              Gestión
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('gestion.assign.index') }}" class="nav-link {{isRouteActive('gestion.assign.')}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Asignar Solicitudes</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index2.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Archivar Solicitudes</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index2.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Eliminar Solicitudes</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="{{ route('ticket.index') }}" class="nav-link {{isRouteActive('ticket.')}}">
            <i class="nav-icon fa fa-ticket"></i>
            <p>
              Solicitudes
            </p>
          </a>
        </li>

        <li class="nav-header pt-4">CONFIGURACIÓN</li>

        <li class="nav-item {{isMenuOpen('config.incidents.')}}">
          <a href="#" class="nav-link {{isRouteActive('config.incidents.')}}">
            <i class="fa-solid fa-signs-post"></i>
            <p>
              Incidencias
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('config.incidents.type.index') }}" class="nav-link {{isRouteActive('config.incidents.type.')}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Tipos</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index2.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Categorias</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="{{ route('config.priority.index') }}" class="nav-link {{isRouteActive('config.priority.')}}">
            <i class="fa-solid fa-temperature-half"></i>
            <p>
              Prioridades
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('config.department.index') }}" class="nav-link {{isRouteActive('config.department.')}}">
            <i class="fa-regular fa-building"></i>
            <p>
              Departamentos
            </p>
          </a>
        </li>

        <li class="nav-header pt-4">REPORTES</li>

        <li class="nav-item">
          <a href="../calendar.html" class="nav-link">
            <i class="fa-regular fa-square-plus"></i>
            <p>
              Nuevos
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fa-regular fa-clock"></i>
            <p>
              Pendientes
            </p>
          </a>
        </li>

        @if (auth()->user()->can('admin-user-show') || 
          auth()->user()->can('admin-role-show') || 
          auth()->user()->can('admin-permission-show'))

          <li class="nav-header pt-4">ADMINISTRACIÓN</li>

          @can('admin-user-show')
            <li class="nav-item">
              <a href="{{ route('admin.user.index') }}" class="nav-link {{isRouteActive('admin.user')}}">
                <i class="fa-solid fa-users"></i>
                <p>
                  Usuarios
                </p>
              </a>
            </li>
          @endcan

          @can('admin-role-show')
            <li class="nav-item">
              <a href="{{ route('admin.role.index') }}" class="nav-link {{isRouteActive('admin.role')}}" >
                <i class="fa-solid fa-unlock"></i>
                <p>
                  Roles
                </p>
              </a>
            </li>
          @endcan

          @can('admin-permission-show')
            <li class="nav-item">
              <a href="{{ route('admin.permission.index') }}" 
              class="nav-link {{isRouteActive('admin.permission')}}">
                <i class="fa-solid fa-key"></i>
                <p>
                  Permisos
                </p>
              </a>
            </li>
          @endcan
        @endif

      </ul>
    </nav>
  </div>
</aside>