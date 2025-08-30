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
          <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="../calendar.html" class="nav-link">
              <i class="nav-icon fa fa-bolt"></i>
              <p>
                DashBoard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="../calendar.html" class="nav-link">
              <i class="nav-icon fa fa-bolt"></i>
              <p>
                Gestión
                <span class="badge badge-info right">2</span>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="../calendar.html" class="nav-link">
              <i class="nav-icon fa fa-ticket"></i>
              <p>
                Tickets
              </p>
            </a>
          </li>

          <li class="nav-header pt-4">CONFIGURACIÓN</li>

          <li class="nav-item">
            <a href="../calendar.html" class="nav-link">
              <i class="fa-solid fa-signs-post"></i>
              <p>
                Tipos
                <span class="badge badge-info right">2</span>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fa-solid fa-temperature-half"></i>
              <p>
                Prioridad
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

          <li class="nav-header pt-4">ADMINISTRACIÓN</li>

          <li class="nav-item">
            <a href="../calendar.html" class="nav-link">
              <i class="fa-solid fa-users"></i>
              <p>
                Usuarios
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fa-solid fa-unlock"></i>
              <p>
                Roles
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fa-solid fa-key"></i>
              <p>
                Permisos
              </p>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>