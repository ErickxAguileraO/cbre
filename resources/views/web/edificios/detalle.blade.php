@extends('layout.web')

@section('title', $edificio->edi_nombre)

@section('content')
    @push('extra-css')
        <style>
            body {
                background-color: #F1F7F9;
            }

            #map {
                height: 480px !important;
            }
        </style>
    @endpush

    <div class="contenido">
        <div class="portada">
            <img class="mostrar-escritorio" src="{{ $edificio->urlImagen }}" alt="">
            <img class="mostrar-movil" src="{{ $edificio->urlImagen }}" alt="">
        </div>

        <div class="txt-caracteristicas">
            <div class="txt">
                <div class="sub-menu">
                    <a href="/">Estás en <p>inicio</p></a>
                    <p>></p>
                    <a href="/edificios-oficinas">
                        <p>Edificios y oficinas</p>
                    </a>
                    <p>></p>
                    <a href="{{route('web.edificios.detalle', [$edificio->edi_id, Str::slug($edificio->edi_nombre , "-")])}}">{{ $edificio->edi_nombre }}</a>
                </div>
                <p class="txt-1">{{ $edificio->edi_descripcion }}</p>
            </div>
            {{-- <div class="caracteristicas">
                <h2>Amenities del edificio</h2>
                @if (count($edificio->caracteristicas) >= 5)
                <div class="carruselCaracteristicas">
                    @foreach ($edificio->caracteristicas as $caracteristica)
                        <div class="caracteristica-n">
                            <img class="imagen-icon-caracteristicas" src="{{ $caracteristica->urlImagen }}" alt="">
                            <p>{{ $caracteristica->car_nombre }}</p>
                        </div>
                    @endforeach
                </div>
                @else
                <div class="flex-carrusel">
                    @foreach ($edificio->caracteristicas as $caracteristica)
                        <div class="caracteristica-n">
                            <img class="imagen-icon-caracteristicas" src="{{ $caracteristica->urlImagen }}" alt="">
                            <p>{{ $caracteristica->car_nombre }}</p>
                        </div>
                    @endforeach
                </div>
                @endif --}}
            </div>


            @if($edificio->edi_video)
                <div class="caracteristicas">
                    <h2>Amenities del edificio</h2>
                    @if (count($edificio->caracteristicas) >= 5)
                    <div class="carruselCaracteristicas">
                        @foreach ($edificio->caracteristicas as $caracteristica)
                            <div class="caracteristica-n">
                                <img class="imagen-icon-caracteristicas" src="{{ $caracteristica->urlImagen }}" alt="">
                                <p>{{ $caracteristica->car_nombre }}</p>
                            </div>
                        @endforeach
                    </div>
                    @else
                    <div class="flex-carrusel">
                        @foreach ($edificio->caracteristicas as $caracteristica)
                            <div class="caracteristica-n">
                                <img class="imagen-icon-caracteristicas" src="{{ $caracteristica->urlImagen }}" alt="">
                                <p>{{ $caracteristica->car_nombre }}</p>
                            </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            @else
                <div class="caracteristicas2">
                    <h2>Amenities del edificio</h2>
                    @if (count($edificio->caracteristicas) >= 5)
                    <div class="carruselCaracteristicas">
                        @foreach ($edificio->caracteristicas as $caracteristica)
                            <div class="caracteristica-n">
                                <img class="imagen-icon-caracteristicas" src="{{ $caracteristica->urlImagen }}" alt="">
                                <p>{{ $caracteristica->car_nombre }}</p>
                            </div>
                        @endforeach
                    </div>
                    @else
                    <div class="flex-carrusel">
                        @foreach ($edificio->caracteristicas as $caracteristica)
                            <div class="caracteristica-n">
                                <img class="imagen-icon-caracteristicas" src="{{ $caracteristica->urlImagen }}" alt="">
                                <p>{{ $caracteristica->car_nombre }}</p>
                            </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            @endif
        </div>
        @if ($edificio->edi_video)
            <section class="video-edificio">
                <iframe src="{{ $edificio->edi_video }}" title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen></iframe>
            </section>
        @endif
        <section class="galeria-imagenes">
            <h2>Galería de imágenes</h2>
            <div class="galeria">
                @if ($edificio->imagenes->count() != 0)
                    <div class="galeria-img-1">
                        <a href="{{ $edificio->imagenes->first()->urlImagen }}" data-fancybox="gallery">
                            <img src="{{ $edificio->imagenes->first()->urlImagen }}" />
                        </a>
                    </div>
                    <div class="galeria-img-2">
                        @foreach ($edificio->imagenes->skip(1) as $index => $imagen)
                            @if ($index == 5)
                            @break
                        @endif
                            <a href="{{ $imagen->urlImagen }}" data-fancybox="gallery">
                                <img src="{{ $imagen->urlImagen }}">
                            </a>
                        @endforeach
                        @foreach ($edificio->imagenes->skip(5) as $imagen)
                            <a href="{{ $imagen->urlImagen }}" data-fancybox="gallery" style="display:none">
                                <img src="{{ $imagen->urlImagen }}">
                            </a>
                        @endforeach
                </div>
            @endif
        </div>
    </section>

    @if (count($edificio->noticias) >= 1)
    <section class="flex-noticias-edificio">
        <div class="noticias-home">
            <h2 class="h2-internas">Noticias destacadas</h2>
            <p class="p-txt-seccion">Conoce las últimas novedades o acontecimientos de nuestro Edificio</p>
            @if (count($edificio->noticias) >= 3)
                <div class="carruselNoticias">
                    @foreach ($edificio->noticias as $noticia)
                        <div class="noticia-home-n">
                            <a
                                href="{{ route('web.noticias.detalle', [$noticia->not_id, Str::slug($noticia->not_titulo, '-')]) }}">
                                <div class="">
                                    <img src="{{ $noticia->urlImagen }}" class="imagen-noticias" alt="">
                                </div>
                                <div class="contenido-noticia-n">
                                    <div class="date-noticia">
                                        <img src="{{ asset('public/web/imagenes/i-calendario.svg') }}" alt="">
                                        <p>Publicado el {{ $noticia->fechaChile }} {{ $noticia->hora }}</p>
                                    </div>
                                    <h2>{{ $noticia->not_titulo }}</h2>
                                    <a href="{{ route('web.noticias.detalle', [$noticia->not_id, Str::slug($noticia->not_titulo, '-')]) }}"
                                        class="ver-mas">
                                        <img src="{{ asset('public/web/imagenes/i-linea.svg') }}" alt="">
                                        <p>Ver noticia</p>
                                    </a>
                                </div>

                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex-carrusel">
                    @foreach ($edificio->noticias as $noticia)
                        <div class="noticia-home-n">
                            <a
                                href="{{ route('web.noticias.detalle', [$noticia->not_id, Str::slug($noticia->not_titulo, '-')]) }}">
                                <div class="">
                                    <img src="{{ $noticia->urlImagen }}" class="imagen-noticias" alt="">
                                </div>
                                <div class="contenido-noticia-n">
                                    <div class="date-noticia">
                                        <img src="{{ asset('public/web/imagenes/i-calendario.svg') }}" alt="">
                                        <p>Publicado el {{ $noticia->fechaChile }} {{ $noticia->hora }}</p>
                                    </div>
                                    <h2>{{ $noticia->not_titulo }}</h2>
                                    <a href="{{ route('web.noticias.detalle', [$noticia->not_id, Str::slug($noticia->not_titulo, '-')]) }}"
                                        class="ver-mas">
                                        <img src="{{ asset('public/web/imagenes/i-linea.svg') }}" alt="">
                                        <p>Ver noticia</p>
                                    </a>
                                </div>

                            </a>
                        </div>
                    @endforeach
                </div>
            @endif

            <a href="/noticias" class="style-link">Ver todas las noticias</a>
        </div>
    </section>
    @endif

    @if (count($edificio->comercios) >= 1)
    <section class="flex-certificaciones-edificio">
        <div class="certificaciones-home">
            <h2 class="h2-internas">Locales comerciales</h2>
            <p>En el edificio podrás encontrar diferentes locales comerciales, visítalos:</p>
            @if (count($edificio->comercios) >= 5)
                <div class="carruselCertificaciones">
                    @foreach ($edificio->comercios as $comercio)
                        <div class="certificacion-home-n">
                            <img class="imagen-comercio" src="{{ $comercio->urlImagen }}" alt="">
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex-carrusel">
                    @foreach ($edificio->comercios as $comercio)
                        <div class="certificacion-home-n">
                            <img class="imagen-comercio" src="{{ $comercio->urlImagen }}" alt="">
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </section>
    @endif

    @if (count($edificio->certificaciones) >= 1)
    <section class="flex-certificaciones-edificio">
        <div class="certificaciones-home">
            <h1 class="h2-internas">Nuestras certificaciones</h1>
            @if (count($edificio->certificaciones) >= 5)
            <div class="carruselCertificaciones">
                @foreach ($edificio->certificaciones as $certificacion)
                    <div class="certificacion-home-n">
                        <img src="{{ $certificacion->urlImagen }}" alt="">
                    </div>
                @endforeach
            </div>
                @else
                <div class="flex-carrusel">
                    @foreach ($edificio->certificaciones as $certificacion)
                        <div class="certificacion-home-n">
                            <img src="{{ $certificacion->urlImagen }}" alt="">
                        </div>
                    @endforeach
                </div>
            @endif
            <p class="p-txt-seccion">Te presentamos las certificaciones que hemos obtenido</p>
        </div>
    </section>
    @endif

    <section class="flex-ubicacion-edificio">
        <div class="ubicacion-edificio">
            <div>
                <div class="ubicacion-edificio-left-content">
                    <h2>{{ $edificio->ubi_titulo }}</h2>
                    <p id="direccionRegistrada" data-direccion-registrada="{{ $edificio->edi_direccion }}"><span
                            class="edificio-detalle-direccion">Dirección:</span> {{ $edificio->edi_direccion }}</p>
                    <p>@php echo htmlspecialchars_decode($edificio->ubi_descripcion) @endphp</p>
                </div>
            </div>
            <div>
                <div id="map" data-latitud="{{ $edificio->edi_latitud }}"
                    data-longitud="{{ $edificio->edi_longitud }}"></div>
            </div>
        </div>
    </section>

    <section class="flex-operaciones">
        <div class="operaciones">

            @foreach ($edificio->funcionarios->filter(function ($funcionario) {
        return $funcionario->fun_cargo == 'Jefe de operaciones';
    }) as $funcionario)
                <div class="operaciones-contenido">
                    <h2>Jefe de operaciones del edificio</h2>
                    <div class="operacion-n">
                        <img class="imagen-funcionarios img" src="{{ $funcionario->urlImagen }}" alt="">
                        <div class="txt-operacion">
                            <h4>{{ $funcionario->fun_nombre }} {{ $funcionario->fun_apellido }}</h4>
                            <p class="cursive">{{ $funcionario->fun_cargo }}</p>
                            <div class="telefono-correo-operacion">
                                <img src="{{ asset('public/web/imagenes/i-telefono-green.svg') }}" alt="">
                                <p>+56 {{ PrintPhone($funcionario->fun_telefono) }}</p>
                            </div>
                            <a href="mailto:{{ $funcionario->user->email }}" class="telefono-correo-operacion">
                                <img src="{{ asset('public/web/imagenes/i-correo-green.svg') }}" alt="">
                                <p>Enviar un correo</p>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
            @foreach ($edificio->funcionarios->filter(function ($funcionario) {
        return $funcionario->fun_cargo == 'Asistente de operaciones';
    }) as $funcionario)
                <div class="operaciones-contenido">
                    <h2>Asistente de operaciones</h2>
                    <div class="operacion-n">
                        <img class="imagen-funcionarios img" src="{{ $funcionario->urlImagen }}" alt="">
                        <div class="txt-operacion">
                            <h4>{{ $funcionario->fun_nombre }} {{ $funcionario->fun_apellido }}</h4>
                            <p class="cursive">{{ $funcionario->fun_cargo }}</p>
                            <div class="telefono-correo-operacion">
                                <img src="{{ asset('public/web/imagenes/i-telefono-green.svg') }}" alt="">
                                <p>+56 {{ PrintPhone($funcionario->fun_telefono) }}</p>
                            </div>
                            <a href="mailto:{{ $funcionario->user->email }}" class="telefono-correo-operacion">
                                <img src="{{ asset('public/web/imagenes/i-correo-green.svg') }}" alt="">
                                <p>Enviar un correo</p>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </section>
</div>

@push('extra-js')
    <script>
        Fancybox.bind('[data-fancybox="gallery"]', {
            // Your custom options
        });
    </script>
    <script src="{{ asset('public/js/admin/sistema/edificios/google_map_modificar.js') }}"></script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initMap">
    </script>
@endpush

@endsection
