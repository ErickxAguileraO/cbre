@extends('layout.web')

@section('title', 'Inicio')

@section('content')
    @push('extra-css')
        <style>
            body{
                background-color: #F1F7F9;
            }
        </style>
    @endpush
    
    <div class="contenido">
        <div class="portada">
            <img class="mostrar-escritorio" src="{{ asset('public/web/imagenes/portada-escritorio.svg') }}" alt="">
            <img class="mostrar-movil" src="{{ asset('public/web/imagenes/portada-movil.svg') }}" alt="">
        </div>

        <div class="txt-caracteristicas">
            <div class="txt">
                <div class="sub-menu">
                    <a href="/">Estás en <p>inicio</p></a>
                    <p>></p>
                    <a href="/edificios-oficinas"> <p>Edificios y oficinas</p></a>
                    <p>></p>
                    <a href="/edificios-oficinas-detalle">Nombre edificio</a>
                </div>
                <p class="txt-1">But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete</p>
            </div>
            <div class="caracteristicas">
                <h2>Características del edificio</h2>
                <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti </p>
                <div class="carruselCaracteristicas">
                    <div class="caracteristica-n">
                        <img src="{{ asset('public/web/imagenes/i-areas-verdes.svg') }}" alt="">
                        <p>Áreas verdes</p>
                    </div>
                    <div class="caracteristica-n">
                        <img src="{{ asset('public/web/imagenes/i-ascensor.svg') }}" alt="">
                        <p>Ascensor</p>
                    </div>
                    <div class="caracteristica-n">
                        <img src="{{ asset('public/web/imagenes/i-bicicleta.svg') }}" alt="">
                        <p>Bicicletero</p>
                    </div>
                    <div class="caracteristica-n">
                        <img src="{{ asset('public/web/imagenes/i-banco.svg') }}" alt="">
                        <p>Banco</p>
                    </div>
                    <div class="caracteristica-n">
                        <img src="{{ asset('public/web/imagenes/i-camarines.svg') }}" alt="">
                        <p>Camarines</p>
                    </div>
                </div>
            </div>
        </div>
        <section class="video-edificio">
            <iframe src="https://www.youtube.com/embed/u4GvS85tf-U" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </section>

        <section class="galeria-imagenes">
            <h2>Galería de imágenes</h2>
            <div class="galeria">
                <div class="galeria-img-1">
                    <div><a href="{{ asset('public/web/imagenes/galeria1.svg') }}" class="fresco"><img src="{{ asset('public/web/imagenes/galeria1.svg') }}" alt=""></a></div>
                </div>
                <div class="galeria-img-2">
                    <div><a href="{{ asset('public/web/imagenes/galeria2.svg') }}" class="fresco"><img src="{{ asset('public/web/imagenes/galeria2.svg') }}" alt=""></a></div>
                    <div><a href="{{ asset('public/web/imagenes/galeria3.svg') }}" class="fresco"><img src="{{ asset('public/web/imagenes/galeria3.svg') }}" alt=""></a></div>
                    <div><a href="{{ asset('public/web/imagenes/galeria4.svg') }}" class="fresco"><img src="{{ asset('public/web/imagenes/galeria4.svg') }}" alt=""></a></div>
                    <div><a href="{{ asset('public/web/imagenes/galeria5.svg') }}" class="fresco"><img src="{{ asset('public/web/imagenes/galeria5.svg') }}" alt=""></a></div>
                </div>
            </div>
        </section>

        <section class="flex-noticias-edificio">
            <div class="noticias-home">
                <h2 class="h2-internas">Noticias destacadas</h2>
                <p class="p-txt-seccion">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias</p>
                <div class="carruselNoticias">
                    <div  class="noticia-home-n">
                        <a href="#">
                            <div class="img-noticia">
                            </div>
                            <div class="contenido-noticia-n">
                                <div class="date-noticia">
                                    <img src="{{ asset('public/web/imagenes/i-calendario.svg') }}" alt="">
                                    <p>Publicado el 21 Enero 2023</p>
                                </div>
                                <h2>But I must explain to you how all this mistaken idea of denouncing</h2>
                                <a href="/noticias-detalle" class="ver-mas">
                                    <img src="{{ asset('public/web/imagenes/i-linea.svg') }}" alt="">
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
                                    <img src="{{ asset('public/web/imagenes/i-calendario.svg') }}" alt="">
                                    <p>Publicado el 21 Enero 2023</p>
                                </div>
                                <h2>But I must explain to you how all this mistaken idea of denouncing</h2>
                                <a href="/noticias-detalle" class="ver-mas">
                                    <img src="{{ asset('public/web/imagenes/i-linea.svg') }}" alt="">
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
                                    <img src="{{ asset('public/web/imagenes/i-calendario.svg') }}" alt="">
                                    <p>Publicado el 21 Enero 2023</p>
                                </div>
                                <h2>But I must explain to you how all this mistaken idea of denouncing</h2>
                                <a href="/noticias-detalle" class="ver-mas">
                                    <img src="{{ asset('public/web/imagenes/i-linea.svg') }}" alt="">
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
                                    <img src="{{ asset('public/web/imagenes/i-calendario.svg') }}" alt="">
                                    <p>Publicado el 21 Enero 2023</p>
                                </div>
                                <h2>But I must explain to you how all this mistaken idea of denouncing</h2>
                                <a href="/noticias-detalle" class="ver-mas">
                                    <img src="{{ asset('public/web/imagenes/i-linea.svg') }}" alt="">
                                    <p>Ver noticia</p>
                                </a>
                            </div>
                            
                        </a>
                    </div>
                </div>
                <a href="/noticias" class="style-link">Ver todas las noticias</a>
            </div>
        </section>
        
        <section class="flex-certificaciones-edificio">
            <div class="certificaciones-home">
                <h2 class="h2-internas">Locales comerciales</h2>
                <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias</p>
                <div class="carruselCertificaciones">
                    <div class="certificacion-home-n">
                        <img src="{{ asset('public/web/imagenes/cuadrado.svg') }}" alt="">
                    </div>
                    <div class="certificacion-home-n">
                        <img src="{{ asset('public/web/imagenes/cuadrado.svg') }}" alt="">
                    </div>
                    <div class="certificacion-home-n">
                        <img src="{{ asset('public/web/imagenes/cuadrado.svg') }}" alt="">
                    </div>
                    <div class="certificacion-home-n">
                        <img src="{{ asset('public/web/imagenes/cuadrado.svg') }}" alt="">
                    </div>
                    <div class="certificacion-home-n">
                        <img src="{{ asset('public/web/imagenes/cuadrado.svg') }}" alt="">
                    </div>
                    <div class="certificacion-home-n">
                        <img src="{{ asset('public/web/imagenes/cuadrado.svg') }}" alt="">
                    </div>
                </div>
            </div>
        </section>

        <section class="flex-certificaciones-edificio">
            <div class="certificaciones-home">
                <h1 class="h2-internas">Nuestras certificaciones</h1>
                <div class="carruselCertificaciones">
                    <div class="certificacion-home-n">
                        <img src="{{ asset('public/web/imagenes/certificaciones-1.svg') }}" alt="">
                    </div>
                    <div class="certificacion-home-n">
                        <img src="{{ asset('public/web/imagenes/certificaciones-2.svg') }}" alt="">
                    </div>
                    <div class="certificacion-home-n">
                        <img src="{{ asset('public/web/imagenes/certificaciones-3.svg') }}" alt="">
                    </div>
                    <div class="certificacion-home-n">
                        <img src="{{ asset('public/web/imagenes/certificaciones-4.svg') }}" alt="">
                    </div>
                    <div class="certificacion-home-n">
                        <img src="{{ asset('public/web/imagenes/certificaciones-5.svg') }}" alt="">
                    </div>
                    <div class="certificacion-home-n">
                        <img src="{{ asset('public/web/imagenes/certificaciones-4.svg') }}" alt="">
                    </div>
                    <div class="certificacion-home-n">
                        <img src="{{ asset('public/web/imagenes/certificaciones-5.svg') }}" alt="">
                    </div>
                </div>
                <p class="p-txt-seccion">But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete</p>
            </div>
        </section>

        <section class="flex-ubicacion-edificio">
            <div class="ubicacion-edificio">
                <div>
                    <h2>Excelente ubicación</h2>
                    <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident</p>
                </div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d25553.02992894051!2d-73.03175265790662!3d-36.81543480483304!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9669b43c049c81c9%3A0x5738f7fe1749e32f!2sTerminal%20Collao%20Concepcion!5e0!3m2!1ses!2scl!4v1675110667488!5m2!1ses!2scl"  style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </section>

        <section class="flex-operaciones">
            <div class="operaciones">
                <div class="operaciones-contenido">
                    <h2>Jefe de operaciones del edificio</h2>
                    <div class="operacion-n">
                        <img class="img" src="{{ asset('public/web/imagenes/img-jefe.svg') }}" alt="">
                        <div class="txt-operacion">
                            <h4>Carlos Ambiado</h4>
                            <p class="cursive">Asset & Property Managing Director</p>
                            <div class="telefono-correo-operacion">
                                <img src="{{ asset('public/web/imagenes/i-telefono-green.svg') }}" alt="">
                                <p>+56934567898</p>
                            </div>
                            <a href="mailto:prueba@aeurus.cl" class="telefono-correo-operacion">
                                <img src="{{ asset('public/web/imagenes/i-correo-green.svg') }}" alt="">
                                <p>Enviar un correo</p>
                            </a>
                        </div>
                    </div>
                </div>

{{-- 

                <div  class="operaciones-contenido">
                    <h2>Asistente de operaciones</h2>
                    <div class="operacion-n">
                        <img class="img" src="{{ asset('public/web/imagenes/img-jefe.svg') }}" alt="">
                        <div class="txt-operacion">
                            <h4>Carlos Ambiado</h4>
                            <p class="cursive">Asset & Property Managing Director</p>
                            <div class="telefono-correo-operacion">
                                <img src="{{ asset('public/web/imagenes/i-telefono-green.svg') }}" alt="">
                                <p>+56934567898</p>
                            </div>
                            <a href="" class="telefono-correo-operacion">
                                <img src="{{ asset('public/web/imagenes/i-correo-green.svg') }}" alt="">
                                <p>Enviar un correo</p>
                            </a>
                        </div>
                    </div>
                </div> --}}
                
            </div>
            
        </section>
    </div>

    @push('extra-js')
   
    @endpush

@endsection
