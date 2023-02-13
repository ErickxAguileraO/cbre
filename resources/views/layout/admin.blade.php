<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Aeurus Ltda.">
  <title>@yield('title')</title>

  <!-- CSS -->
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
  <link href="{{ asset('public/css/admin/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('public/js/admin/jquery/bootstrap/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('public/js/admin/jquery/select2-4.0.7/dist/css/select2.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('public/css/admin/admin-estilos.css') }}" rel="stylesheet" type="text/css">
  <link href="https://cdn3.devexpress.com/jslib/21.2.4/css/dx.light.css" rel="stylesheet" type="text/css" />
  <link href="{{ asset('public/js/admin/jquery/devextreme/devextreme.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('public/js/admin/jquery/sweetalert2/css/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
  @stack('stylesheets')

  <!-- favicon -->
  <link href="{{ asset('public/images/admin/logo-white.svg') }}" rel="shortcut icon" />
</head>

<body>
<div id="wrapper">
  <nav class="navbar navbar-dark fixed-top flex-md-nowrap shadow">
    <figure class="navbar-brand"><img src="{{ asset('public/images/admin/logo-white.svg') }}"></figure>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
    <div class="dropdown">
      <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Nombre usuario</button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="width: 100%;"> <a class="dropdown-item logout" href="">Cerrar sesión</a> </div>
    </div>
  </nav>
  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="sidebar-sticky accordion" id="accordionMenu">
          <ul class="nav flex-column">

            <li>
              <span class="nav-item nav-link collapsed" data-toggle="collapse" data-target="#nav_1" data-parent="#accordionMenu" aria-expanded="false" aria-controls="nav_1">
                <a href="{{ route('noticias.index') }}" class="nav-link">Noticias</a> 
              </span>
            </li>

            <li>
              <span class="nav-item nav-link collapsed" data-toggle="collapse" data-target="#nav_1" data-parent="#accordionMenu" aria-expanded="false" aria-controls="nav_1">
                <a href="" class="nav-link">Edificios</a> 
              </span>
            </li>

            <li>
              <span class="nav-item nav-link collapsed" data-toggle="collapse" data-target="#nav_1" data-parent="#accordionMenu" aria-expanded="false" aria-controls="nav_1">
                <a href="{{ route('certificaciones.index') }}" class="nav-link">Certificaciones</a> 
              </span>
            </li>

            <li>
              <span class="nav-item nav-link collapsed" data-toggle="collapse" data-target="#nav_1" data-parent="#accordionMenu" aria-expanded="false" aria-controls="nav_1">
                <a href="" class="nav-link">Características</a> 
              </span>
            </li>

            <li>
              <span class="nav-item nav-link collapsed" data-toggle="collapse" data-target="#nav_1" data-parent="#accordionMenu" aria-expanded="false" aria-controls="nav_1">
                <a href="" class="nav-link">Submercados</a> 
              </span>
            </li>

            <li>
              <span class="nav-item nav-link collapsed" data-toggle="collapse" data-target="#nav_1" data-parent="#accordionMenu" aria-expanded="false" aria-controls="nav_1">
                <a href="" class="nav-link">Locales comerciales</a> 
              </span>
            </li>

            <li>
              <span class="nav-item nav-link collapsed" data-toggle="collapse" data-target="#nav_1" data-parent="#accordionMenu" aria-expanded="false" aria-controls="nav_1">
                <a href="" class="nav-link">Indicadores</a> 
              </span>
            </li>

            <li>
              <span class="nav-item nav-link collapsed" data-toggle="collapse" data-target="#nav_1" data-parent="#accordionMenu" aria-expanded="false" aria-controls="nav_1">
                <a href="" class="nav-link">Quiénes somos</a> 
              </span>
            </li>

            <li>
              <span class="nav-item nav-link collapsed" data-toggle="collapse" data-target="#nav_1" data-parent="#accordionMenu" aria-expanded="false" aria-controls="nav_1">
                <a href="" class="nav-link">Funcionarios</a> 
              </span>
            </li>

          </ul>
        </div>
      </nav>
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <section class="pdtb"> @yield('content')</section>
      </main>
    </div>
  </div>
</div>

<!-- JS -->
<script src="{{ asset('public/js/admin/jquery/3.6.0/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('public/js/admin/jquery/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/js/admin/jquery/select2-4.0.7/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('public/js/admin/jquery/select2-4.0.7/dist/js/select2-init.js') }}"></script>
<script src="{{ asset('public/js/admin/jquery/devextreme/devextreme.js') }}"></script>
<script src="{{ asset('public/js/admin/jquery/devextreme/dx.messages.es.js') }}"></script>
<script src="{{ asset('public/js/admin/jquery/sweetalert2/js/sweetalert2.min.js') }}"></script>
<script src="{{ asset('public/js/admin/sistema/validaciones_inputs.js') }}"></script>
@stack('scripts')
</body>
</html>
