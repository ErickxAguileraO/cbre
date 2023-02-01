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
        <div class="buscador-input">
            <div class="input-buscar">
                <input type="search">
                <button class="btn-lupa"><img src="{{ asset('web/imagenes/i-buscar.svg') }}" alt=""></button>
                {{-- <img src="{{ asset('web/imagenes/i-buscar.svg') }}" alt=""> --}}
            </div>
            <div class="input-buscar">
                <select name="" id="">
                    <option value="">opcion 1</option>
                    <option value="">opcion 2</option>
                    <option value="">opcion 3</option>
                </select>
            </div>
        </div>
        <div class="sub-menu">
            <a href="/">Estás en <p>inicio</p></a>
            <p>></p>
            <a href="/edificios-oficinas">Edificios y oficinas</a>
        </div>

        <p class="txt-busqueda">1.450 edificios encontrados en “Santiago centro”</p>

        <div class="edificios-busqueda">
            <div class="edificios-n">
                <div class="img-edificio">
                    {{-- <img src="{{ asset('web/imagenes/img-edificio.svg') }}" alt=""> --}}
                    <div class="ubi-white">
                        <img src="{{ asset('web/imagenes/i-gps-white.svg') }}" alt="">
                        <p>Santiago Centro, Santiago</p>
                    </div>
                </div>
                <div class="txt-edificio">
                    <h2>Edificio Bandera</h2>
                    <div class="ubi-green">
                        <img src="{{ asset('web/imagenes/i-gps-green.svg') }}" alt="">
                        <p>Santiago Centro, Santiago</p>
                    </div>
                    <p>Edificio Bandera, es un edificio clase B, el cual cuenta con sistema de clima y de detección de incendios [...]</p>
                    <a href="/edificios-oficinas-detalle" class="ver-mas">
                        <img src="{{ asset('web/imagenes/i-linea.svg') }}" alt="">
                        <p>Ver edificio</p>
                    </a>
                </div>
            </div>
            {{--  --}}
            <div class="edificios-n">
                <div class="img-edificio">
                    {{-- <img src="{{ asset('web/imagenes/img-edificio.svg') }}" alt=""> --}}
                    <div class="ubi-white">
                        <img src="{{ asset('web/imagenes/i-gps-white.svg') }}" alt="">
                        <p>Santiago Centro, Santiago</p>
                    </div>
                </div>
                <div class="txt-edificio">
                    <h2>Edificio Bandera</h2>
                    <div class="ubi-green">
                        <img src="{{ asset('web/imagenes/i-gps-green.svg') }}" alt="">
                        <p>Santiago Centro, Santiago</p>
                    </div>
                    <p>Edificio Bandera, es un edificio clase B, el cual cuenta con sistema de clima y de detección de incendios [...]</p>
                    <a href="/edificios-oficinas-detalle" class="ver-mas">
                        <img src="{{ asset('web/imagenes/i-linea.svg') }}" alt="">
                        <p>Ver edificio</p>
                    </a>
                </div>
            </div>
            {{--  --}}
            <div class="edificios-n">
                <div class="img-edificio">
                    {{-- <img src="{{ asset('web/imagenes/img-edificio.svg') }}" alt=""> --}}
                    <div class="ubi-white">
                        <img src="{{ asset('web/imagenes/i-gps-white.svg') }}" alt="">
                        <p>Santiago Centro, Santiago</p>
                    </div>
                </div>
                <div class="txt-edificio">
                    <h2>Edificio Bandera</h2>
                    <div class="ubi-green">
                        <img src="{{ asset('web/imagenes/i-gps-green.svg') }}" alt="">
                        <p>Santiago Centro, Santiago</p>
                    </div>
                    <p>Edificio Bandera, es un edificio clase B, el cual cuenta con sistema de clima y de detección de incendios [...]</p>
                    <a href="/edificios-oficinas-detalle" class="ver-mas">
                        <img src="{{ asset('web/imagenes/i-linea.svg') }}" alt="">
                        <p>Ver edificio</p>
                    </a>
                </div>
            </div>



            <div class="edificios-n">
                <div class="img-edificio">
                    {{-- <img src="{{ asset('web/imagenes/img-edificio.svg') }}" alt=""> --}}
                    <div class="ubi-white">
                        <img src="{{ asset('web/imagenes/i-gps-white.svg') }}" alt="">
                        <p>Santiago Centro, Santiago</p>
                    </div>
                </div>
                <div class="txt-edificio">
                    <h2>Edificio Bandera</h2>
                    <div class="ubi-green">
                        <img src="{{ asset('web/imagenes/i-gps-green.svg') }}" alt="">
                        <p>Santiago Centro, Santiago</p>
                    </div>
                    <p>Edificio Bandera, es un edificio clase B, el cual cuenta con sistema de clima y de detección de incendios [...]</p>
                    <a href="/edificios-oficinas-detalle" class="ver-mas">
                        <img src="{{ asset('web/imagenes/i-linea.svg') }}" alt="">
                        <p>Ver edificio</p>
                    </a>
                </div>
            </div>
            {{--  --}}
            <div class="edificios-n">
                <div class="img-edificio">
                    {{-- <img src="{{ asset('web/imagenes/img-edificio.svg') }}" alt=""> --}}
                    <div class="ubi-white">
                        <img src="{{ asset('web/imagenes/i-gps-white.svg') }}" alt="">
                        <p>Santiago Centro, Santiago</p>
                    </div>
                </div>
                <div class="txt-edificio">
                    <h2>Edificio Bandera</h2>
                    <div class="ubi-green">
                        <img src="{{ asset('web/imagenes/i-gps-green.svg') }}" alt="">
                        <p>Santiago Centro, Santiago</p>
                    </div>
                    <p>Edificio Bandera, es un edificio clase B, el cual cuenta con sistema de clima y de detección de incendios [...]</p>
                    <a href="/edificios-oficinas-detalle" class="ver-mas">
                        <img src="{{ asset('web/imagenes/i-linea.svg') }}" alt="">
                        <p>Ver edificio</p>
                    </a>
                </div>
            </div>
            {{--  --}}
            <div class="edificios-n">
                <div class="img-edificio">
                    {{-- <img src="{{ asset('web/imagenes/img-edificio.svg') }}" alt=""> --}}
                    <div class="ubi-white">
                        <img src="{{ asset('web/imagenes/i-gps-white.svg') }}" alt="">
                        <p>Santiago Centro, Santiago</p>
                    </div>
                </div>
                <div class="txt-edificio">
                    <h2>Edificio Bandera</h2>
                    <div class="ubi-green">
                        <img src="{{ asset('web/imagenes/i-gps-green.svg') }}" alt="">
                        <p>Santiago Centro, Santiago</p>
                    </div>
                    <p>Edificio Bandera, es un edificio clase B, el cual cuenta con sistema de clima y de detección de incendios [...]</p>
                    <a href="/edificios-oficinas-detalle" class="ver-mas">
                        <img src="{{ asset('web/imagenes/i-linea.svg') }}" alt="">
                        <p>Ver edificio</p>
                    </a>
                </div>
            </div>
        </div>
    </div>

    @push('extra-js')
   
    @endpush

@endsection
