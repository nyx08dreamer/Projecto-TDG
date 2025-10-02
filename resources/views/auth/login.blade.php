<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicio de Sesión | {{ env('APP_NAME') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">

  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <!-- /.login-logo -->
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <a href="{{ route('login') }}" class="h1"><b>Sentinel</b>IM</a>
        </div>
        <div class="card-body">
          <p class="login-box-msg">Inicia sesión para ingresar</p>

          <form method="post" action="{{ route('auth.login') }}">
            @csrf
            <div class="input-group mb-3">
              <input type="text" class="form-control" id="username" name="username" placeholder="Usuario">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>

            <div class="input-group mb-3">
              <input type="password" class="form-control" id="password" name="password"  placeholder="Contraseña">
              <div class="input-group-append">
                <button class="input-group-text" type="button" id="togglePassword" style="border-left: none;">
                  <span class="fas fa-eye" id="eyeIcon"></span>
                </button>
              </div>
            </div>

            @error('username')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <div class="row">
              <div class="col-7">
                <div class="icheck-primary">
                  <input type="checkbox" id="remember">
                  <label for="remember">
                    Recuerdame
                  </label>
                </div>
              </div>

              <div class="col-5">
                <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
              </div>
            </div>
          </form>

          <p class="mt-3 mb-1">
            <a href="forgot-password.html">¿Olvidaste tu contraseña?</a>
          </p>
        </div>
      </div>
    </div>

    <script>
      document.addEventListener('DOMContentLoaded', function() {
          const toggleButton = document.getElementById('togglePassword');
          const passwordInput = document.getElementById('password');
          const eyeIcon = document.getElementById('eyeIcon');
          
          if (toggleButton && passwordInput && eyeIcon) {
              toggleButton.addEventListener('click', function() {
                  if (passwordInput.type === 'password') {
                      // Mostrar contraseña
                      passwordInput.type = 'text';
                      eyeIcon.classList.remove('fa-eye');
                      eyeIcon.classList.add('fa-eye-slash');
                  } else {
                      // Ocultar contraseña
                      passwordInput.type = 'password';
                      eyeIcon.classList.remove('fa-eye-slash');
                      eyeIcon.classList.add('fa-eye');
                  }
              });
          }
      });
    </script>

    <!-- jQuery -->
    <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('assets/dist/js/adminlte.min.js')}}"></script>
  </body>
</html>