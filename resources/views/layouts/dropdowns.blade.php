
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          @foreach (auth()->user()->unreadNotifications as $notification) 
          <p>{{ $notification->data['message'] ?? 'Sin mensaje disponible' }}</p>
          <div class="dropdown-divider"></div>
          @endforeach

          {{-- https://www.blackbox.ai/chat/AIc9QfH --}}

          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
      
      <!--begin::User Menu Dropdown-->
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          <img src="{{asset('storage/image_profiles/'.auth()->user()->image_path)}}" class="user-image img-circle elevation-2" alt="User Image">
          @if(auth()->user())
              <span class="d-none d-md-inline">{{ auth()->user()->first_name }}</span>
              @else
              <span class="d-none d-md-inline">Visitante</span>
          @endif
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- User image -->
          <li class="user-header bg-primary">
            <img src="{{asset('storage/image_profiles/'.auth()->user()->image_path)}}" class="img-circle elevation-2" alt="User Image">
            @if(auth()->user())
                <p>
                  {{ auth()->user()->first_name }}
                  <small>Cargo</small>
                </p>
                @else
                <p>
                  Visitante
                  <small>Cargo</small>
                </p>
            @endif
          </li>
          <!-- Menu Body -->
          <li class="user-body">
            <div class="row">
              <div class="col-4 text-center">
                <a href="{{ route('admin.user.show', auth()->user()->id) }}">Perfil</a>
              </div>
              <div class="col-8 text-center">
                <a href="#">Cambiar Contraseña</a>
              </div>
            </div>
            <!-- /.row -->
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <a href="#" class="btn btn-default btn-flat float-right" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar Sesión</a>
            <form id="logout-form" action="{{ route('auth.logout') }}" method="post" style="display: none;">
                @csrf
            </form>
          </li>
        </ul>
      </li>
      <!--end::User Menu Dropdown-->