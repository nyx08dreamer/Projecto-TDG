
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      
      <!--begin::User Menu Dropdown-->
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          <img src="{{asset('storage/image_profiles/'.auth()->user()->image_path)}}" class="user-image img-circle elevation-2" alt="User Image">
          @if(auth()->user())
              <span class="d-none d-md-inline">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</span>
              @else
              <span class="d-none d-md-inline">Visitante</span>
          @endif
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- User image -->
          <li class="user-header bg-primary">
            <img src="{{asset('storage/image_profiles/'.auth()->user()->image_path)}}" class="img-circle elevation-2" alt="User Image">
            @if(auth()->user())
                <p class="pb-1">
                  {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                </p>
                @else
                <p>
                  Visitante
                  <small>Cargo</small>
                </p>
            @endif
          </li>
          <li class="user-footer">
            <a href="{{ route('admin.user.show', auth()->user()->id) }}"  class="btn btn-default btn-flat float-left">Perfil</a>
            <a href="#" class="btn btn-default btn-flat float-right" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar Sesión</a>
            <form id="logout-form" action="{{ route('auth.logout') }}" method="post" style="display: none;">
                @csrf
            </form>
          </li>
        </ul>
      </li>
      <!--end::User Menu Dropdown-->