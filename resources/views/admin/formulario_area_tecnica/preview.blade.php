@extends('layout.admin')
@section('title', 'Crear formulario')
@section('content')
@push('stylesheets')
<link rel="stylesheet" href="{{ asset('/public/css/componentes/tab/tab.css') }}">
<link rel="stylesheet" href="{{ asset('/public/css/componentes/modal/modal.css') }}">

<style>
    body {
        background: #F2F2F2;
    }

    main[role=main] {
        background: #F2F2F2;
    }

    .form-group {
        margin: 0px;
    }
</style>

@endpush
<div id="" class="formulario nuevo-formulario">
    <form action="#" method="POST" id="tab1" class="tab__contenido">
        <div class="grid-header-2">
            <h1 class="col-xl">Formulario equipo de limpieza</h1>
            <div class="row datos-formulario">
                <a href="/crear-formulario" class="estado-formulario">Salir del modo previsualizar</a>
            </div>
        </div>

        <div class="contenedor-form-preguntas">
            <div class="div-formulario-n">
                <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum
                    deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non
                    provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum
                    fuga.</p>
            </div>

            <div class="div-formulario-n">
                <h3 class="bottom-30">1. ¿Cuando fue la ultima vez que se realizó mantención al ascensor principal?</h3>
                <div class="row align-center preguntas-preview">
                    <input type="radio">
                    <p>Esta semana</p>
                </div>
                <div class="row align-center preguntas-preview">
                    <input type="radio">
                    <p>La semana pasada</p>
                </div>
                <div class="row align-center preguntas-preview">
                    <input type="radio">
                    <p>El mes pasado</p>
                </div>
                <div class="linea-separadora"></div>
                <p>Obligatoria</p>
            </div>

            <div class="div-formulario-n">
                <h3 class="bottom-30">2. ¿Cuando fue la ultima vez que se realizó mantención al ascensor principal?</h3>
                <div class="row align-center preguntas-preview">
                    <input type="checkbox">
                    <p>Esta semana</p>
                </div>
                <div class="row align-center preguntas-preview">
                    <input type="checkbox">
                    <p>La semana pasada</p>
                </div>
                <div class="row align-center preguntas-preview">
                    <input type="checkbox">
                    <p>El mes pasado</p>
                </div>
            </div>

            <div class="div-formulario-n">
                <h3 class="bottom-30">3. ¿Cuando fue la ultima vez que se realizó mantención al ascensor principal?</h3>
                <div class="form-group">
                    <textarea name="" id="" class="form-control" cols="30" rows="10"></textarea>

                </div>
                <div class="linea-separadora"></div>
                <p>Obligatoria</p>
            </div>
        </div>


        <div class="botones-formulario">
            <button class="modalFile__btnN modalFile__botonPrimario modalPublicar__abrirBtn">Enviar encuesta</button>
        </div>

        {{-- Modal Publicar --}}
        @include('components.modalPublicar')
    </form>

</div>
@endsection

@push('scripts')
<script src="{{ asset('public\js\admin\sistema\caracteristicas\form_agregar.js') }}"></script>
<script src="{{ asset('/public/css/componentes/tab/tab.js') }}"></script>
<script src="{{ asset('/public/css/componentes/modal/modal.js') }}"></script>
<script src="{{ asset('/public/js/script.js') }}"></script>

@endpush