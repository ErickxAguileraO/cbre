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
                <select name="edificio" id="edificio" style="width: 100%;">
                    <option>Buscar edificio...</option>
                    @foreach ($edificios as $edificio)
                    <option value="{{$edificio->edi_id}}" data-href="{{route('web.edificios.detalle', [$edificio->edi_id, Str::slug($edificio->edi_nombre , "-")])}}">{{$edificio->edi_nombre}}</option>
                   {{--  <option value="{{$edificio->edi_id}}">{{$edificio->edi_nombre}}</option> --}}
                    @endforeach
                </select>
            </div>
            <div class="input-buscar">
                <select name="submercado" id="submercado" style="width: 100%;">
                    <option value="null">Filtrar por submercado...</option>
                    @foreach ($submercados as $submercado)
                    <option value="{{$submercado->sub_id}}">{{$submercado->sub_nombre}}</option>
                   {{--  <option value="{{$edificio->edi_id}}">{{$edificio->edi_nombre}}</option> --}}
                    @endforeach
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
