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
    <script src="{{ asset('/web/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('/web/js/jquery-ui.js') }}"></script>

    <!-- Estilos -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/web/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/web/js/niceselect/nice-select.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/web/js/slick/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/web/js/fresco/fresco.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/web/js/lightgallery/lightgallery.css') }}">

    @stack('extra-css')
</head>

<body>
    {{-- Barra movil --}}
    <nav class="barra-menu-movil">
        <div class="logo-cerrar">
            <a href="/"><img src="{{ asset('web/imagenes/logo-white.svg') }}" alt=""></a>
            <div>
                <img class="btn-cerrar-menu-bar" src="{{ asset('web/imagenes/i-cerrar.svg') }}" alt="">
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
        <a href="/"><img src="{{ asset('web/imagenes/logo-white.svg') }}" alt=""></a>
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
        <a href="" class="admin-link"><img src="{{ asset('web/imagenes/i-user.svg') }}" alt=""></a>
    </nav>

    {{-- Menu movil --}}
    <div class="header-movil mostrar-movil">
        <a href="/"><img src="{{ asset('web/imagenes/logo-white.svg') }}" alt=""></a>
        <div>
            <a href=""><img src="{{ asset('web/imagenes/i-user.svg') }}" alt=""></a>
            <a class="btn-bar-movil"><img src="{{ asset('web/imagenes/i-bar.svg') }}" alt=""></a>
        </div>
    </div>
    
    @yield('content')

    <footer>
        <div class="info-footer">
            <a href="/"><img src="{{ asset('web/imagenes/logo-white.svg') }}" alt=""></a>
            
            <div class="ubicacion">
                <p>Isidora Goyenechea 2800, piso 35, Edificio Titanium <br> Las Condes, Santiago</p>
            </div>
            <div class="telefonos">
                <p>+56 9 6391 4099</p>
                <p>+56 2 2280 5454</p>
            </div>
            <div class="rrss">
                <a href="https://web.facebook.com/people/CBRE-Chile/100082811220906/" target="_blank"><img src="{{ asset('web/imagenes/i-fb.svg') }}" alt=""></a>
                <a href="https://www.linkedin.com/company/cbre-chile/posts/?feedView=all" target="_blank"><img src="{{ asset('web/imagenes/i-link.svg') }}" alt=""></a>
                <a href="https://www.instagram.com/cbre_chile/" target="_blank"><img src="{{ asset('web/imagenes/i-ig.svg') }}" alt=""></a>
                <a href="https://twitter.com/cbre_chile" target="_blank"><img src="{{ asset('web/imagenes/i-twt.svg') }}" alt=""></a>
                <a href="https://www.youtube.com/channel/UCWGZ1B04oRa9iIf6xGrB1NQ?app=desktop"x target="_blank"><img src="{{ asset('web/imagenes/i-yt.svg') }}" alt=""></a>

            </div>
        </div>
        <div class="sub-footer">
            <a href="https://www.cbre.cl/es-cl/servicios">Servicios</a>
            <a href="https://www.cbre.cl/es-cl/informes-de-mercado">Report y Research</a>
            <a href="https://antdigital.cl/">Diseñado y Desarrollado por ANTDIGITAL</a>
            <a href="https://www.cbre.cl/es-cl/acerca-de-cbre/terminos-de-uso">Términos de servicio</a>
            <a href="https://www.cbre.cl/es-cl/acerca-de-cbre/politica-de-privacidad">Políticas de privacidad</a>
        </div>
    </footer>
    <!-- Scripts -->
    <script src="{{ asset('web/js/niceselect/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('web/js/slick/slick.min.js') }}"></script>
    <script src="{{ asset('web/js/fresco/fresco.min.js') }}"></script>
    <script src="{{ asset('web/js/lightgallery/lightgallery.min.js') }}"></script>
    
    <script type="text/javascript">
        lightGallery(document.getElementById('lightgallery')); 
    </script>

    <script src="{{ asset('web/js/script.js') }}"></script>
    <script>
        $('select').niceSelect();
    </script>
    
    @stack('extra-js')

</body>
</html>
