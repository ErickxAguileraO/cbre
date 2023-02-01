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
            <img class="mostrar-escritorio" src="{{ asset('web/imagenes/portada-escritorio.svg') }}" alt="">
            <img class="mostrar-movil" src="{{ asset('web/imagenes/portada-movil.svg') }}" alt="">
        </div>

        <div class="flex-contenido-seccion">
            <div class="contenido-seccion">
                <div class="sub-menu">
                    <a href="/">Estás en <p>inicio</p></a>
                    <p>></p>
                    <a href="/noticias-detalle">Contáctanos</a>
                </div>

                <h2 style="text-align: center;">Nuestra incomparable presencia en todo el mundo garantiza que contamos con los mejores especialistas inmobiliarios disponibles en los sitios más relevantes para nuestros clientes</h2>
                <div class="formulario-contacto">
                    <form action="">
                        <div class="input-linea">
                            <img src="{{ asset('web/imagenes/input-nombre.svg') }}" alt="">
                            <input type="text" placeholder="Nombre y apellido">
                        </div>

                        <div class="input-linea">
                            <img src="{{ asset('web/imagenes/input-email.svg') }}" alt="">
                            <input type="text" placeholder="Email">
                        </div>

                        <div class="input-linea">
                            <img src="{{ asset('web/imagenes/input-telefono.svg') }}" alt="">
                            <input type="text" placeholder="Telefono">
                        </div>

                        <div class="textarea-linea">
                            <img src="{{ asset('web/imagenes/input-mensaje.svg') }}" alt="">

                            <textarea name="" id="" placeholder="Mensaje"></textarea>
                        </div>

                        <button class="btn-contacto">Enviar mensaje</button>
                    </form>
                    <div class="operaciones-contenido" style="text-align: left;">
                        <h2>Jefe de operaciones</h2>
                        <div class="operacion-n">
                            <img class="img" src="{{ asset('web/imagenes/img-jefe.svg') }}" alt="">
                            <div class="txt-operacion">
                                <h4>Carlos Ambiado</h4>
                                <p class="cursive">Asset & Property Managing Director</p>
                                <div class="telefono-correo-operacion">
                                    <img src="{{ asset('web/imagenes/i-telefono-green.svg') }}" alt="">
                                    <p>+56934567898</p>
                                </div>
                                <a href="mailto:prueba@aeurus.cl" class="telefono-correo-operacion">
                                    <img src="{{ asset('web/imagenes/i-correo-green.svg') }}" alt="">
                                    <p>Enviar un correo</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('extra-js')
   
    @endpush

@endsection
