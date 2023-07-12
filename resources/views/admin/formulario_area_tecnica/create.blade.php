@extends('layout.admin')
@section('title', 'Crear formulario')
@section('content')
    @push('stylesheets')
      <link rel="stylesheet" href="{{ asset('/public/css/componentes/tab/tab.css') }}">
      <link rel="stylesheet" href="{{ asset('/public/css/componentes/modal/modal.css') }}">

        <style>
            body{
                background: #F2F2F2;
            }
            main[role=main]{
                background: #F2F2F2;
            }
            .form-group{
                margin: 0px;
            }
        </style>

    @endpush
    <div  id="" class="formulario nuevo-formulario">

        <livewire:administracion.formulario.post-form :formId="$formulario->form_id"/>

        <a href="{{ route('formulario-area-tecnica.index') }}" class="row row-responsive link-atras">
            <i class="far fa-arrow-left"></i>
            Volver al listado
        </a>
        <div class="tab">
            <ul class="tab__lista-botones">
                <li class="tab__boton" onclick="mostrarTab(event, 'tab1')" style="border-radius: 8px 0px 0px 8px;">
                    <p class="tab__nombre">Formulario</p>
                </li>

                <li class="tab__boton" onclick="mostrarTab(event, 'tab2')" style="border-radius: 0px 8px 8px 0px;">
                    <p class="tab__nombre">Historial</p>
                </li>
            </ul>

            <form action="#" method="POST" id="tab1" class="tab__contenido">
                <div class="grid-header-2">
                    <h1 class="col-xl">Formulario equipo de limpieza</h1>
                    <div class="row datos-formulario">
                        <p class="margin-top-5">Estado</p>
                        <div class="estado-formulario">Borrador</div>
                        <div class="form-group">
                            <div class="select-manual" class="">
                                <p>Opciones</p>
                                <i class="fas fa-sort-down color-texto-cbre menos-top"></i>

                                <div class="option-select-manual">

                                    <div class="row-option modalPublicar__abrirBtn"><i class ="fas fa-eye"></i> Publicar y enviar</div>
                                    <a href="{{ route('formulario-area-tecnica.show', $formulario->form_id) }}" class="row-option"><i class="fas fa-eye"></i> Visualizar</a>
{{--                                     <div class="row-option modalPublicar__abrirBtn"><i class ="fas fa-eye"></i> Publicar y enviar</div> --}}
                                    <div class="row-option"><i class="fas fa-copy"></i> Duplicar</div>
                                    <div id="eliminar-formulario" class="row-option"><i class="fas fa-trash-alt"></i> Eliminar</div>
                                    <div class="row-option modalObservacion__abrirBtn"><i class="fas fa-edit"></i> Observación</div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="contenedor-form-preguntas">
                    <livewire:administracion.formulario.create-form :formId="$formulario->form_id"/>
                </div>

                <div class="linea-separadora"></div>
                <div class="botones-formulario">
                    <a id="eliminar-formulario" class="modalFile__cerrarBtn modalFile__btnN modalFile__botonSecundario text-dark text-decoration-none">Eliminar</a>
                    <input type="hidden" id="form_id" name="form_id" value="{{ $formulario->form_id }}">
                    <a href="{{ route('formulario-area-tecnica.index') }}" class="modalFile__btnN modalFile__botonPrimario text-white text-decoration-none">Dejar como borrador</a>
                </div>

            </form>

            <div id="tab2" class="tab__contenido">
                <h1 class="col-xl">Historial formulario</h1>
                <div class="div-formulario-n">
                    <div class="historial">
                        <div class="historial__linea">
                            <div class="historial__lineaCirculo"></div>
                        </div>
                        <div class="historial__datos sin-margen">
                            <p>21 Nov 2023</p>
                            <h3>Creación de formulario</h3>
                            <p>Estado: Borrador</p>
                            <p>Creado por Benjamín Arias</p>
                        </div>
                    </div>

                    <div class="historial">
                        <div class="historial__linea">
                            <div class="historial__lineaCirculo"></div>
                        </div>
                        <div class="historial__datos sin-margen">
                            <p>21 Nov 2023</p>
                            <h3>Creación de formulario</h3>
                            <p>Estado: Borrador</p>
                            <p>Creado por Benjamín Arias</p>
                        </div>
                    </div>

                    <div class="historial">
                        <div class="historial__linea">
                            <div class="historial__lineaCirculo"></div>
                        </div>
                        <div class="historial__datos sin-margen">
                            <p>21 Nov 2023</p>
                            <h3>Creación de formulario</h3>
                            <p>Estado: Borrador</p>
                            <p>Creado por Benjamín Arias</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal observacion --}}
{{--     @include('components.modalObservacion') --}}
@endsection

@push('scripts')
    <script>
        // Opciones
        $(".option-select-manual").hide();
        $(".select-manual").click(function () {
            $(".option-select-manual").toggle();
        })

        // Modal publicar
        $(".modalPublicar__abrirBtn").on('click', function () {
            $(".contenedor__modalPublicar").css("display", "flex");
            $('#mySelect').val('').trigger('change');
            $('#mySelect').select2();
        });

        $(".modalPublicar__cerrarBtn").on('click', function () {
            $(".contenedor__modalPublicar").css("display", "none");
        });
    </script>
        <script src="{{ asset('/public\js\admin\sistema\area_tecnica\publicar_formulario.js') }}"></script>
    <script src="{{ asset('/public\js\admin\sistema\area_tecnica\eliminar_formulario.js') }}"></script>
    <script src="{{ asset('/public/css/componentes/tab/tab.js') }}"></script>
{{--     <script src="{{ asset('/public/css/componentes/modal/modal.js') }}"></script>
    <script src="{{ asset('/public/js/script.js') }}"></script> --}}
@endpush
