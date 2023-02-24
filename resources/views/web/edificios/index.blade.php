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
        <div class="buscador-input">
            <div class="input-buscar">
                <input type="search" placeholder="Escribe aquí el nombre del edificio">
                <button class="btn-lupa"><img src="{{ asset('public/web/imagenes/i-buscar.svg') }}" alt=""></button>
                {{-- <img src="{{ asset('public/web/imagenes/i-buscar.svg') }}" alt=""> --}}
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

        <p class="txt-busqueda">{{$edificios->count()}} edificios encontrados en total</p>

        <div class="edificios-busqueda" id="edificios-busqueda">

        </div>
        <div style="margin-top: 50px">
            <span id="spinner" class="loader" style="display: none"></span>
        </div>

    </div>

    @push('extra-js')
        <script src="{{ asset('public\web\js\edificio.js') }}"></script>
    @endpush

@endsection
