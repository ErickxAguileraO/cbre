@extends('layout.web')

@section('title', 'Inicio')

@section('content')
    @push('extra-css')
    @endpush
    
    <div class="contenido">
        <div class="portada">
            <img class="mostrar-escritorio" src="{{ asset('web/imagenes/portada-escritorio.svg') }}" alt="">
            <img class="mostrar-movil" src="{{ asset('web/imagenes/portada-movil.svg') }}" alt="">
        </div>
        <div class="buscador">
            <h2>Encuentra la oficina ideal en el edificio que gustes</h2>
            <div class="input-buscar">
                <input type="search">
                <img src="{{ asset('web/imagenes/i-buscar.svg') }}" alt="">
            </div>
            <button class="boton-buscar">Buscar por submercado ></button>
        </div>

        <section class="quienes-somos-home">
            <div class="txt">
                <h1>Quienes Somos</h1>
                <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.

                    cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.</p>
            </div>
            <div class="flex-img">
                <div class="img">
                    <img src="{{ asset('web/imagenes/img2.svg') }}" alt="">
                </div>
            </div>
            
        </section>

        <section class="contador-home">
            <div class="contador-n">
                <div class="contador ocultar-animate"><h1>+</h1><div class="contador_cantidad" data-cantidad-total="500">0</div></div>
                <p>Edificios administrados</p>
            </div>
            <div class="contador-n">
                <div class="contador ocultar-animate"><h1>+</h1><div class="contador_cantidad" data-cantidad-total="500">0</div></div>
                <p>Clientes confian en nosotros</p>
            </div>
            <div class="contador-n">
                <div class="contador ocultar-animate"><h1>+</h1><div class="contador_cantidad" data-cantidad-total="500">0</div></div>
                <p>Oficinas en todo Chile</p>
            </div>
            <div class="contador-n">
                <div class="contador ocultar-animate"><h1>+</h1><div class="contador_cantidad" data-cantidad-total="500">0</div></div>
                <p>Oficinas en todo Chile</p>
            </div>
        </section>

        <section class="flex-noticias-home">
            <div class="noticias-home">
                <h1>Noticias destacadas</h1>
                <p class="p-txt-seccion">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias</p>
                <div class="carruselNoticias">
                    <div  class="noticia-home-n">
                        <a href="#">
                            <div class="img-noticia">
                            </div>
                            <div class="contenido-noticia-n">
                                <div class="date-noticia">
                                    <img src="{{ asset('web/imagenes/i-calendario.svg') }}" alt="">
                                    <p>Publicado el 21 Enero 2023</p>
                                </div>
                                <h2>But I must explain to you how all this mistaken idea of denouncing</h2>
                                <a href="/noticias-detalle" class="ver-mas">
                                    <img src="{{ asset('web/imagenes/i-linea.svg') }}" alt="">
                                    <p>Ver noticia</p>
                                </a>
                            </div>
                            
                        </a>
                    </div>
                    <div  class="noticia-home-n">
                        <a href="#">
                            <div class="img-noticia">
                            </div>
                            <div class="contenido-noticia-n">
                                <div class="date-noticia">
                                    <img src="{{ asset('web/imagenes/i-calendario.svg') }}" alt="">
                                    <p>Publicado el 21 Enero 2023</p>
                                </div>
                                <h2>But I must explain to you how all this mistaken idea of denouncing</h2>
                                <a href="/noticias-detalle" class="ver-mas">
                                    <img src="{{ asset('web/imagenes/i-linea.svg') }}" alt="">
                                    <p>Ver noticia</p>
                                </a>
                            </div>
                            
                        </a>
                    </div>
                    <div  class="noticia-home-n">
                        <a href="#">
                            <div class="img-noticia">
                            </div>
                            <div class="contenido-noticia-n">
                                <div class="date-noticia">
                                    <img src="{{ asset('web/imagenes/i-calendario.svg') }}" alt="">
                                    <p>Publicado el 21 Enero 2023</p>
                                </div>
                                <h2>But I must explain to you how all this mistaken idea of denouncing</h2>
                                <a href="/noticias-detalle" class="ver-mas">
                                    <img src="{{ asset('web/imagenes/i-linea.svg') }}" alt="">
                                    <p>Ver noticia</p>
                                </a>
                            </div>
                            
                        </a>
                    </div>

                    <div  class="noticia-home-n">
                        <a href="#">
                            <div class="img-noticia">
                                {{-- <img src="{{ asset('/web/imagenes/img2.svg') }}" alt=""> --}}
                            </div>
                            <div class="contenido-noticia-n">
                                <div class="date-noticia">
                                    <img src="{{ asset('web/imagenes/i-calendario.svg') }}" alt="">
                                    <p>Publicado el 21 Enero 2023</p>
                                </div>
                                <h2>But I must explain to you how all this mistaken idea of denouncing</h2>
                                <a href="/noticias-detalle" class="ver-mas">
                                    <img src="{{ asset('web/imagenes/i-linea.svg') }}" alt="">
                                    <p>Ver noticia</p>
                                </a>
                            </div>
                            
                        </a>
                    </div>
                </div>
                <a href="/noticias" class="style-link">Ver todas las noticias</a>
            </div>
        </section>

        <section class="flex-certificaciones-home">
            <div class="certificaciones-home">
                <h1>Nuestras certificaciones</h1>
                <div class="carruselCertificaciones">
                    <div class="certificacion-home-n">
                        <img src="{{ asset('web/imagenes/certificaciones-1.svg') }}" alt="">
                    </div>
                    <div class="certificacion-home-n">
                        <img src="{{ asset('web/imagenes/certificaciones-2.svg') }}" alt="">
                    </div>
                    <div class="certificacion-home-n">
                        <img src="{{ asset('web/imagenes/certificaciones-3.svg') }}" alt="">
                    </div>
                    <div class="certificacion-home-n">
                        <img src="{{ asset('web/imagenes/certificaciones-4.svg') }}" alt="">
                    </div>
                    <div class="certificacion-home-n">
                        <img src="{{ asset('web/imagenes/certificaciones-5.svg') }}" alt="">
                    </div>
                    <div class="certificacion-home-n">
                        <img src="{{ asset('web/imagenes/certificaciones-4.svg') }}" alt="">
                    </div>
                    <div class="certificacion-home-n">
                        <img src="{{ asset('web/imagenes/certificaciones-5.svg') }}" alt="">
                    </div>
                </div>
                <p class="p-txt-seccion">But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete</p>
            </div>
        </section>
    </div>

    @push('extra-js')
   
    @endpush

@endsection
