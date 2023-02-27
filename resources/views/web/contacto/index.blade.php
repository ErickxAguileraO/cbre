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

        <div class="flex-contenido-seccion">
            <div class="contenido-seccion">
                <div class="sub-menu">
                    <a href="/">Estás en <p>inicio</p></a>
                    <p>></p>
                    <a href="/noticias-detalle">Contáctanos</a>
                </div>

                <h2 style="text-align: center;">Nuestra incomparable presencia en todo el mundo garantiza que contamos con los mejores especialistas inmobiliarios disponibles en los sitios más relevantes para nuestros clientes</h2>
                <div class="formulario-contacto">
                    <form action="#" method="POST" id="form-contacto" class="formulario">
                        @csrf
                        <div>
                            <div class="input-linea">
                                <img src="{{ asset('public/web/imagenes/input-nombre.svg') }}" alt="">
                                <input type="text" id="nombre" name="nombre" placeholder="Nombre y apellido" class="solo-letras" data-maximo-caracteres="50">
                            </div>
                            <span style="color: red; display: block; text-align: left; font-size: small; margin-bottom: 20px;" id="nombre_error"></span>
                        </div>

                        <div>
                            <div class="input-linea">
                                <img src="{{ asset('public/web/imagenes/input-email.svg') }}" alt="">
                                <input type="email" id="email" name="email" placeholder="Email">
                            </div>
                            <span style="color: red; display: block; text-align: left; font-size: small; margin-bottom: 20px;" id="email_error"></span>
                        </div>

                        <div>
                            <div class="input-linea">
                                <img src="{{ asset('public/web/imagenes/input-telefono.svg') }}" alt="">
                                <input type="text" id="telefono" name="telefono" placeholder="Telefono" class="solo-numeros" data-maximo-caracteres="9">
                            </div>
                            <span style="color: red; display: block; text-align: left; font-size: small; margin-bottom: 20px;" id="telefono_error"></span>
                        </div>

                        <div>
                            <div class="textarea-linea">
                                <img src="{{ asset('public/web/imagenes/input-mensaje.svg') }}" alt="">
                                <textarea name="mensaje" id="mensaje" placeholder="Mensaje" data-maximo-caracteres="2000"></textarea>
                            </div>
                            <span style="color: red; display: block; text-align: left; font-size: small; margin-bottom: 20px;" id="mensaje_error"></span>
                        </div>

                        <div class="btn-contacto-div">
                            <button class="btn-contacto" id="btn-contacto">
                                <span>Enviar mensaje</span>
                                <span id="btn-spinner" style="display: none" class="loader-btn"></span>
                        </button>
                        </div>
                    </form>
                    <div class="operaciones-contenido" style="text-align: left;">
                        <h2>Jefe de operaciones</h2>
                        <div class="operacion-n">
                            <img class="imagen-jefe-operaciones img" src="{{ $datos_generales->urlImagen }}" alt="">
                            <div class="txt-operacion">
                                <h4>{{$datos_generales->dag_nombre_encargado}}</h4>
                                <p class="cursive">{{$datos_generales->dag_cargo_encargado}}</p>
                                <div class="telefono-correo-operacion">
                                    <img src="{{ asset('public/web/imagenes/i-telefono-green.svg') }}" alt="">
                                    <p>+56{{PrintPhone($datos_generales->dag_telefono_encargado)}}</p>
                                </div>
                                <a href="mailto:{{$datos_generales->dag_email_encargado}}" class="telefono-correo-operacion">
                                    <img src="{{ asset('public/web/imagenes/i-correo-green.svg') }}" alt="">
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
        <script src="{{ asset('public\web\js\contacto.js') }}"></script>
    @endpush

@endsection
