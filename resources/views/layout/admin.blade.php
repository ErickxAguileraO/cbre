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
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap" rel="stylesheet">
  @stack('stylesheets')

  <!-- favicon -->
  <link href="{{ asset('public/images/admin/logo-white.svg') }}" rel="shortcut icon" />
</head>

<body>
<div id="wrapper">
  <nav class="navbar navbar-dark fixed-top flex-md-nowrap shadow py-4 header">
    <div class="navbar-brand">
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
        <a href="/">
            <img class="ml-sm-0 pl-sm-0 ml-5 pl-4" src="{{ asset('public/images/admin/logo-white.svg') }}">
        </a>
    </div>
    <div class="dropdown">
      @auth
      <span class="mx-2">{{ auth()->user()->name }}</span>
      <a href="" id="logoutLink"><span class="mx-2" title="Salir"><i class="fa-solid fa-right-from-bracket"></i></span></a>
      <form action="{{ route('logout') }}" method="POST" id="logoutForm" class="oculto">@csrf</form>
      @endauth
    </div>
  </nav>
  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="sidebar-sticky accordion" id="accordionMenu">
          <ul class="nav flex-column">

            @can('index noticias')
            <li>
              <span class="nav-item nav-link collapsed" data-toggle="collapse" data-target="#nav_1" data-parent="#accordionMenu" aria-expanded="false" aria-controls="nav_1">
                <a href="{{ route('noticias.index') }}" class="nav-link {{ request()->routeIs('noticias.index', 'noticias.create', 'noticias.edit') ? ' active' : '' }}">Noticias</a>
              </span>
            </li>
            @endcan

            @can('index edificios')
            <li>
              <span class="nav-item nav-link collapsed" data-toggle="collapse" data-target="#nav_1" data-parent="#accordionMenu" aria-expanded="false" aria-controls="nav_1">
                <a href="{{ route('edificios.index') }}" class="nav-link {{ request()->routeIs('edificios.index', 'edificios.create', 'edificios.edit') ? ' active' : '' }}">Edificios</a>
              </span>
            </li>
            @endcan

            @can('index certificaciones')
            <li>
              <span class="nav-item nav-link collapsed" data-toggle="collapse" data-target="#nav_1" data-parent="#accordionMenu" aria-expanded="false" aria-controls="nav_1">
                <a href="{{ route('certificaciones.index') }}" class="nav-link {{ request()->routeIs('certificaciones.index', 'certificaciones.create', 'certificaciones.edit') ? ' active' : '' }}">Certificaciones</a>
              </span>
            </li>
            @endcan

            @can('index caracteristicas')
            <li>
              <span class="nav-item nav-link collapsed" data-toggle="collapse" data-target="#nav_1" data-parent="#accordionMenu" aria-expanded="false" aria-controls="nav_1">
                <a href="{{route('caracteristicas.index')}}" class="nav-link {{ request()->routeIs('caracteristicas.index', 'caracteristicas.create', 'caracteristicas.edit') ? ' active' : '' }}">Características</a>
              </span>
            </li>
            @endcan

            @can('index submercados')
            <li>
              <span class="nav-item nav-link collapsed" data-toggle="collapse" data-target="#nav_1" data-parent="#accordionMenu" aria-expanded="false" aria-controls="nav_1">
                <a href="{{route('submercados.index')}}" class="nav-link {{ request()->routeIs('submercados.index', 'submercados.create', 'submercados.edit') ? ' active' : '' }}">Submercados</a>
              </span>
            </li>
            @endcan

            @can('index comercios')
            <li>
              <span class="nav-item nav-link collapsed" data-toggle="collapse" data-target="#nav_1" data-parent="#accordionMenu" aria-expanded="false" aria-controls="nav_1">
                <a href="{{ route('comercios.index') }}" class="nav-link {{ request()->routeIs('comercios.index', 'comercios.create', 'comercios.edit') ? ' active' : '' }}">Locales comerciales</a>
              </span>
            </li>
            @endcan

            @can('index indicadores')
            <li>
              <span class="nav-item nav-link collapsed" data-toggle="collapse" data-target="#nav_1" data-parent="#accordionMenu" aria-expanded="false" aria-controls="nav_1">
                <a href="{{route('indicadores.index')}}" class="nav-link {{ request()->routeIs('indicadores.index', 'indicadores.create', 'indicadores.edit') ? ' active' : '' }}">Indicadores</a>
              </span>
            </li>
            @endcan

            @can('index quienes somos')
            <li>
              <span class="nav-item nav-link collapsed" data-toggle="collapse" data-target="#nav_1" data-parent="#accordionMenu" aria-expanded="false" aria-controls="nav_1">
                <a href="{{route('quienes-somos.index')}}" class="nav-link {{ request()->routeIs('quienes-somos.index', 'quienes-somos.create', 'quienes-somos.edit') ? ' active' : '' }}">Quiénes somos</a>
              </span>
            </li>
            @endcan

            @can('index datos generales')
            <li>
                <span class="nav-item nav-link collapsed" data-toggle="collapse" data-target="#nav_1" data-parent="#accordionMenu" aria-expanded="false" aria-controls="nav_1">
                  <a href="{{route('datos-generales.index')}}" class="nav-link {{ request()->routeIs('datos-generales.index', 'datos-generales.create', 'datos-generales.edit') ? ' active' : '' }}">Datos generales</a>
                </span>
            </li>
            @endcan

            @can('index administradores')
            <li>
                <span class="nav-item nav-link collapsed" data-toggle="collapse" data-target="#nav_1" data-parent="#accordionMenu" aria-expanded="false" aria-controls="nav_1">
                  <a href="{{route('administradores.index')}}" class="nav-link {{ request()->routeIs('administradores.index', 'administradores.create', 'administradores.edit') ? ' active' : '' }}">Administradores</a>
                </span>
            </li>
            @endcan

            @can('index funcionarios')
            <li>
              <span class="nav-item nav-link collapsed" data-toggle="collapse" data-target="#nav_1" data-parent="#accordionMenu" aria-expanded="false" aria-controls="nav_1">
                <a href="{{route('funcionarios.index')}}" class="nav-link {{ request()->routeIs('funcionarios.index', 'funcionarios.create', 'funcionarios.edit') ? ' active' : '' }}">Funcionarios</a>
              </span>
            </li>
            @endcan

            @can('index contactos')
            <li>
                <span class="nav-item nav-link collapsed" data-toggle="collapse" data-target="#nav_1" data-parent="#accordionMenu" aria-expanded="false" aria-controls="nav_1">
                  <a href="{{route('contactos.index')}}" class="nav-link {{ request()->routeIs('contactos.index', 'contactos.create', 'contactos.edit', 'contactos.show') ? ' active' : '' }}">Contactos</a>
                </span>
            </li>
            @endcan

            {{-- Nuevas vistas --}}
            <li>
              <span class="nav-item nav-link collapsed row-menu" data-toggle="collapse" data-target="#nav_1" data-parent="#accordionMenu" aria-expanded="false" aria-controls="nav_1">
                <a href="/formularios-jop" class="nav-link">Formularios JOP</a>
              </span>
            </li>

            <li>
              <span class="nav-item nav-link collapsed row-menu" data-toggle="collapse" data-target="#nav_1" data-parent="#accordionMenu" aria-expanded="false" aria-controls="nav_1">
                <a href="/mantenciones-jop" class="nav-link">Mantenciones JOP</a>
              </span>
            </li>

            <li class="menu-area-tecnica">
              <span class="nav-item nav-link collapsed row-menu" data-toggle="collapse" data-target="#nav_1" data-parent="#accordionMenu" aria-expanded="false" aria-controls="nav_1">
                <a class="nav-link">Área técnica</a>
                <i class="fas fa-sort-down color-texto-cbre menos-top"></i>
              </span>
            </li>

            <li class="sub-menu-area-tecnica">
              <span class="nav-item nav-link collapsed" data-toggle="collapse" data-target="#nav_1" data-parent="#accordionMenu" aria-expanded="false" aria-controls="nav_1">
                <a href="{{ route('formulario-area-tecnica.index') }}" class="nav-link">Formulario Área técnica</a>
                <a href="/mantencion-soporte-tecnico" class="nav-link">Mantención Soporte técnico</a>
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
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/translations/de.js"></script>
<script src="{{ asset('public/js/admin/sistema/configuracion_componentes.js') }}"></script>
<script src="{{ asset('public/js/admin/sistema/header/logout.js') }}"></script>
<script src="{{ asset('public\js\admin\sistema\spinner.js') }}"></script>

<script>
  $(".sub-menu-area-tecnica").hide();
  $(".menu-area-tecnica").click(function() {
    $(".sub-menu-area-tecnica").toggle();
  })
</script>
@stack('scripts')
</body>
</html>
