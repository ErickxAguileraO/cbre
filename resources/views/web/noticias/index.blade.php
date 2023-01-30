@extends('layout.web')

@section('title', 'Inicio')

@section('content')
    @push('extra-css')
    <style>
        body{
            background-color: #F1F7F9;
        }
        .flex-noticias-home {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
            background: #F1F7F9;
            padding-top: 10px;
            padding-bottom: 55px;
        }
    </style>
    @endpush
    
    <div class="contenido">
        <div class="portada">
            <img class="mostrar-escritorio" src="{{ asset('web/imagenes/portada-escritorio.svg') }}" alt="">
            <img class="mostrar-movil" src="{{ asset('web/imagenes/portada-movil.svg') }}" alt="">
        </div>
        <div class="sub-menu">
            <a href="/">Estás en <p>inicio</p></a>
            <p>></p>
            <a href="/edificios-oficinas-detalle">Noticias</a>
        </div>
        <section class="flex-noticias-home">
            <div class="noticias-home">
                <div class="lista-noticias">
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
                                <a href="" class="ver-mas">
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
                                <a href="" class="ver-mas">
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
                                <a href="" class="ver-mas">
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
                                <a href="" class="ver-mas">
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
                                <a href="" class="ver-mas">
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
                                <a href="" class="ver-mas">
                                    <img src="{{ asset('web/imagenes/i-linea.svg') }}" alt="">
                                    <p>Ver noticia</p>
                                </a>
                            </div>
                            
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @push('extra-js')
   
    @endpush

@endsection
