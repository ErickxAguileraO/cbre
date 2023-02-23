<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Metas -->
    <meta name="author" content="Magotteaux">
    <meta name="title" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <!-- Title -->
    <title>CBRE | @yield('title')</title>
    <!-- Jquery-->
    <script src="{{ asset('public/web/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('public/web/js/jquery-ui.js') }}"></script>

    <!-- Estilos -->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/web/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/web/js/slick/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/web/js/fresco/fresco.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/web/js/lightgallery/lightgallery.css') }}">
    <link href="{{ asset('public/js/admin/jquery/select2-4.0.7/dist/css/select2.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/js/admin/jquery/sweetalert2/css/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

    @stack('extra-css')
</head>

<body>
    {{-- Barra movil --}}
    <nav class="barra-menu-movil">
        <div class="logo-cerrar">
            <a href="/"><img src="{{ asset('public/web/imagenes/logo-white.svg') }}" alt=""></a>
            <div>
                <img class="btn-cerrar-menu-bar" src="{{ asset('public/web/imagenes/i-cerrar.svg') }}" alt="">
            </div>
        </div>
        <div class="op1-barra-movil">
            <a href="https://www.cbre.cl/es-cl/acerca-de-cbre" target="_blank">Acerca de</a>
            <a href="https://assetcbre.cl/" target="_blank">Asset Management</a>
            <a href="https://www.cbre.cl/es-cl/servicios/servicios-para-inversores/pm2_property-management" target="_blank">Property</a>
            <a href="https://amenity.cl/" target="_blank">Multifamily</a>
        </div>
        <div class="op2-barra-movil">
            <a href="/">PROPERTY MANAGMENT</a>
            <a href="/edificios-oficinas">EDIFICIOS Y OFICINAS</a>
            <a href="/noticias">NOTICIAS</a>
            <a href="/contacto">CONTÁCTANOS</a>
        </div>
    </nav>

    <!-- Header entorno publico definitivo -->
    <header class="mostrar-escritorio">
        <a href="/"><img src="{{ asset('public/web/imagenes/logo-white.svg') }}" alt=""></a>
        <div>
            <a href="https://www.cbre.cl/es-cl/acerca-de-cbre" target="_blank">Acerca de</a>
            <a href="https://assetcbre.cl/" target="_blank">Asset Management</a>
            <a href="https://www.cbre.cl/es-cl/servicios/servicios-para-inversores/pm2_property-management" target="_blank">Property</a>
            <a href="https://amenity.cl/" target="_blank">Multifamily</a>
        </div>
    </header>
    {{-- Menu escritorio --}}
    <nav class="menu mostrar-escritorio">
        <a href="/">PROPERTY MANAGMENT</a>
        <a href="/edificios-oficinas">EDIFICIOS Y OFICINAS</a>
        <a href="/noticias">NOTICIAS</a>
        <a href="/contacto">CONTÁCTANOS</a>
        <a href="" class="admin-link"><img src="{{ asset('public/web/imagenes/i-user.svg') }}" alt=""></a>
    </nav>

    {{-- Menu movil --}}
    <div class="header-movil mostrar-movil">
        <a href="/"><img src="{{ asset('public/web/imagenes/logo-white.svg') }}" alt=""></a>
        <div>
            <a href=""><img src="{{ asset('public/web/imagenes/i-user.svg') }}" alt=""></a>
            <a class="btn-bar-movil"><img src="{{ asset('public/web/imagenes/i-bar.svg') }}" alt=""></a>
        </div>
    </div>

    @yield('content')

    <footer>
        <div class="info-footer">
            <a href="/"><img src="{{ asset('public/web/imagenes/logo-white.svg') }}" alt=""></a>

            <div class="ubicacion">
                <p>{{$datos_generales->dag_direccion}} <br> {{$datos_generales->comuna->com_nombre}}, {{$datos_generales->comuna->region->reg_nombre}}</p>
            </div>
            <div class="telefonos">
                <p>+56 {{ PrintPhone($datos_generales->dag_telefono_uno) }}</p>
                <p>+56 {{ PrintPhone($datos_generales->dag_telefono_dos) }}</p>
            </div>
            <div class="rrss">
                <a href="{{$datos_generales->dag_facebook}}" target="_blank"><img src="{{ asset('public/web/imagenes/i-fb.svg') }}" alt=""></a>
                <a href="{{$datos_generales->dag_linkedin}}" target="_blank"><img src="{{ asset('public/web/imagenes/i-link.svg') }}" alt=""></a>
                <a href="{{$datos_generales->dag_instagram}}" target="_blank"><img src="{{ asset('public/web/imagenes/i-ig.svg') }}" alt=""></a>
                <a href="{{$datos_generales->dag_twitter}}" target="_blank"><img src="{{ asset('public/web/imagenes/i-twt.svg') }}" alt=""></a>
                <a href="{{$datos_generales->dag_youtube}}" target="_blank"><img src="{{ asset('public/web/imagenes/i-yt.svg') }}" alt=""></a>

            </div>
        </div>
        <div class="sub-footer">
            <a href="https://www.cbre.cl/es-cl/servicios" target="_blank">Servicios</a>
            <a href="https://www.cbre.cl/es-cl/informes-de-mercado" target="_blank">Report y Research</a>
            <a href="https://antdigital.cl/" target="_blank">Diseñado y Desarrollado por ANTDIGITAL</a>
            <a href="https://www.cbre.cl/es-cl/acerca-de-cbre/terminos-de-uso" target="_blank">Términos de servicio</a>
            <a href="https://www.cbre.cl/es-cl/acerca-de-cbre/politica-de-privacidad" target="_blank">Políticas de privacidad</a>
        </div>
    </footer>
    <!-- Scripts -->
    <script src="{{ asset('public/web/js/slick/slick.min.js') }}"></script>
    <script src="{{ asset('public/web/js/fresco/fresco.min.js') }}"></script>
    <script src="{{ asset('public/web/js/lightgallery/lightgallery.min.js') }}"></script>
    <script src="{{ asset('public/js/admin/jquery/select2-4.0.7/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('public/js/admin/jquery/select2-4.0.7/dist/js/select2-init.js') }}"></script>
    <script src="{{ asset('public/js/admin/sistema/validaciones_inputs.js') }}"></script>
    <script src="{{ asset('public/js/admin/jquery/sweetalert2/js/sweetalert2.min.js') }}"></script>

    <script type="text/javascript">
        lightGallery(document.getElementById('lightgallery'));
    </script>

    <script src="{{ asset('public/web/js/script.js') }}"></script>
    <script>
        $('select').niceSelect();
    </script>

    @stack('extra-js')

</body>
</html>
