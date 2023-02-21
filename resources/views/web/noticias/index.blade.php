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
            <img class="mostrar-escritorio" src="{{ asset('public/web/imagenes/portada-escritorio.svg') }}" alt="">
            <img class="mostrar-movil" src="{{ asset('public/web/imagenes/portada-movil.svg') }}" alt="">
        </div>
        <div class="sub-menu">
            <a href="/">Estás en <p>inicio</p></a>
            <p>></p>
            <a href="/noticias">Noticias</a>
        </div>
        <section class="flex-noticias-home">
            <div class="noticias-home">
                <div class="lista-noticias" id="lista-noticias">

                </div>
                <div style="margin-top: 50px">
                    <span id="spinner" class="loader" style="display: none"></span>
                </div>
            </div>
        </section>
    </div>

    @push('extra-js')
    <script src="{{ asset('public\web\js\noticias.js') }}"></script>
    @endpush

@endsection
