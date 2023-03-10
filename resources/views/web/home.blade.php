@extends('layout.web')

@section('title', 'Inicio')

@section('content')
    @push('extra-css')
    @endpush

    <div class="contenido">
        <div class="portada">
            <img class="mostrar-escritorio" src="{{ asset('public/web/imagenes/portada-escritorio.svg') }}" alt="">
            <img class="mostrar-movil" src="{{ asset('public/web/imagenes/portada-movil.svg') }}" alt="">
        </div>
        <div class="buscador">
            <h2>Encuentra la oficina ideal en el edificio que gustes</h2>
            <div class="input-buscar">
                <div class="form-group">
                    <select name="edificio" id="edificio" style="width: 100%;">
                        <option>Buscar edificio...</option>
                        @foreach ($edificios as $edificio)
                        <option value="{{$edificio->edi_id}}" data-href="{{route('web.edificios.detalle', [$edificio->edi_id, Str::slug($edificio->edi_nombre , "-")])}}">{{$edificio->edi_nombre}}</option>
                       {{--  <option value="{{$edificio->edi_id}}">{{$edificio->edi_nombre}}</option> --}}
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <section class="quienes-somos-home">
            <div class="txt">
                <h1>{{$quienes_somos->qus_titulo}}</h1>
                <p>@php echo htmlspecialchars_decode($quienes_somos->qus_texto) @endphp</p>
            </div>
            <div class="flex-img">
                <div class="img">
                    <img src="{{ $quienes_somos->urlImagen }}" alt="">
                </div>
            </div>

        </section>

        <section class="contador-home">
            <div class="contador-n">
                <div class="contador ocultar-animate"><h1>+</h1><div class="contador_cantidad" data-cantidad-total="{{$indicadores->ind_administrados}}">0</div></div>
                <p>Edificios administrados</p>
            </div>
            <div class="contador-n">
                <div class="contador ocultar-animate"><h1>+</h1><div class="contador_cantidad" data-cantidad-total="{{$indicadores->ind_confia_en_nosotros}}">0</div></div>
                <p>Clientes confian en nosotros</p>
            </div>
            <div class="contador-n">
                <div class="contador ocultar-animate"><h1>+</h1><div class="contador_cantidad" data-cantidad-total="{{$indicadores->ind_en_todo_chile}}">0</div></div>
                <p>Oficinas en todo Chile</p>
            </div>
            <div class="contador-n">
                <div class="contador ocultar-animate"><h1>+</h1><div class="contador_cantidad" data-cantidad-total="{{$indicadores->ind_en_todo_chile2}}">0</div></div>
                <p>Metros cuadrados administrados</p>
            </div>
        </section>

        <section class="flex-noticias-home">
            <div class="noticias-home">
                <h1>Noticias destacadas</h1>
                <p class="p-txt-seccion">Revisa las noticias destacadas de los edificios que administramos</p>
                @if (count($noticias) >= 3)
                    <div class="carruselNoticias">
                        @foreach ($noticias as $noticia)
                        <div class="noticia-home-n">
                            <a href="{{route('web.noticias.detalle', [$noticia->not_id, Str::slug($noticia->not_titulo , "-")])}}">
                                <div class="">
                                    <img src="{{ $noticia->urlImagen }}" class="imagen-noticias" alt="">
                                </div>
                                <div class="contenido-noticia-n">
                                    <div class="date-noticia">
                                        <img src="{{ asset('public/web/imagenes/i-calendario.svg') }}" alt="">
                                        <p>Publicado el {{$noticia->fechaChile}} {{$noticia->hora}}</p>
                                    </div>
                                    <h2>{{$noticia->not_titulo}}</h2>
                                    <a href="{{route('web.noticias.detalle', [$noticia->not_id, Str::slug($noticia->not_titulo , "-")])}}" class="ver-mas">
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
                        @foreach ($noticias as $noticia)
                        <div  class="noticia-home-n">
                            <a href="{{route('web.noticias.detalle', [$noticia->not_id, Str::slug($noticia->not_titulo , "-")])}}">
                                <div class="">
                                    <img src="{{ $noticia->urlImagen }}" class="imagen-noticias" alt="">
                                </div>
                                <div class="contenido-noticia-n">
                                    <div class="date-noticia">
                                        <img src="{{ asset('public/web/imagenes/i-calendario.svg') }}" alt="">
                                        <p>Publicado el {{$noticia->fechaChile}} {{$noticia->hora}}</p>
                                    </div>
                                    <h2>{{$noticia->not_titulo}}</h2>
                                    <a href="{{route('web.noticias.detalle', [$noticia->not_id, Str::slug($noticia->not_titulo , "-")])}}" class="ver-mas">
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

        <section class="flex-certificaciones-home">
            <div class="certificaciones-home">
                <h1>Nuestras certificaciones</h1>
                    @if (count($certificaciones) >= 5)
                    <div class="carruselCertificaciones">
                        @foreach ($certificaciones as $certificacion)
                        <div class="certificacion-home-n">
                            <img src="{{ $certificacion->urlImagen }}" alt="">
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="flex-carrusel">
                        @foreach ($certificaciones as $certificacion)
                        <div class="certificacion-home-n">
                            <img src="{{ $certificacion->urlImagen }}" alt="">
                        </div>
                        @endforeach
                    </div>
                    @endif
                <p class="p-txt-seccion">Conoce las certificaciones que tienen nuestros edificios</p>
            </div>
        </section>
    </div>

    @push('extra-js')
    <script>
        $('#edificio').change(function() {
            var option = this.options[this.selectedIndex];
            var url = option.getAttribute('data-href');
            if (url) {
            window.location.href = url;
            }
        });
    </script>
    @endpush

@endsection
