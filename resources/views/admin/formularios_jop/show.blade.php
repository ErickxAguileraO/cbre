@extends('layout.admin')
@section('title', 'Responder formulario')
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

    <a href="{{ route('formulario-area-tecnica.index') }}" class="row row-responsive link-atras">
        <i class="far fa-arrow-left"></i>
        Volver al listado
    </a>

    <div class="grid-header-2">
        <h1 class="col-xl">{{ $formulario->form_nombre }}</h1>
        <div class="row datos-formulario">
            <div class="form-group">
                <div class="select-manual" class="">
                    <p>Opciones</p>
                    <i class="fas fa-sort-down color-texto-cbre menos-top"></i>
                    <div class="option-select-manual">
                        <div class="row-option modalObservacion__abrirBtn"><i class="fas fa-edit"></i> Observación</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="contenedor-form-preguntas">
        <livewire:administracion.formulario.reply-form :formId="$formulario->form_id"/>
    </div>


{{--     @if (isset($observacion))
    <div class="grid-header-2">
        <div class="row datos-formulario">
            <div class="form-group">
                <div class="select-manual">
                    <p>
                        <div class="row-option modalObservacion__abrirBtn"><i class="fas fa-edit"></i>
                            Observación
                        </div>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div id="modalObersacion" class="contenedor__modalObservacion">
        <div class="modalFile">
            <div class="modalFile__header">
                <h3>Observación</h3>
            </div>
            <div class="modalFile__contenedorContenido">

                <p>Observación</p>
                <div class="modalFile__contenido">
                    <div class="form-group">
                        <textarea name="descripcion" id="descripcion" class="form-control" cols="30" rows="10" disabled>
                            {{$observacion->obs_descripcion}}
                        </textarea>
                        <small id="" class="field-message-alert absolute"></small>
                    </div>
                </div>
            </div>

            <div class="modalFile__botones">
                <div class="modalObservacion__cerrarBtn modalFile__btnN modalFile__botonSecundario">Cerrar</div>
            </div>
        </div>
    </div>
@endif --}}

</div>
@endsection

@push('scripts')
<script>
    // Opciones
    $(".option-select-manual").hide();
    $(".select-manual").click(function() {
        $(".option-select-manual").toggle();
    })

    // Modal observacion
    $(".modalObservacion__abrirBtn").on('click', function() {
        $(".contenedor__modalObservacion").css("display", "flex");
    });

    $(".modalObservacion__cerrarBtn").on('click', function() {
        $(".contenedor__modalObservacion").css("display", "none");
    });
</script>
{{-- <script src="{{ asset('public\js\admin\sistema\caracteristicas\form_agregar.js') }}"></script>
<script src="{{ asset('/public/css/componentes/tab/tab.js') }}"></script>
<script src="{{ asset('/public/css/componentes/modal/modal.js') }}"></script>
<script src="{{ asset('/public/js/script.js') }}"></script> --}}
@endpush
