@extends('layout.admin')
@section('title', 'Ver formulario')
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

        <div class="grid-header-2">
            <h1 class="col-xl">{{ $formulario->form_nombre }}</h1>
            @if (auth()->user()->hasRole('funcionario'))
                <div class="row datos-formulario">
                    <a href="{{ route('formulario-jop.index') }}" class="estado-formulario">Salir del modo
                        previsualizar</a>
                    {{--             <a href="{{ route('formulario-area-tecnica.edit', $formulario->form_id) }}" class="estado-formulario">Salir del modo previsualizar</a> --}}
                </div>
            @else
                <div class="row datos-formulario">
                    <a href="{{ route('formulario-area-tecnica.index') }}" class="estado-formulario">Salir del modo
                        previsualizar</a>
                    {{--             <a href="{{ route('formulario-area-tecnica.edit', $formulario->form_id) }}" class="estado-formulario">Salir del modo previsualizar</a> --}}
                </div>
            @endif

        </div>


        <div class="contenedor-form-preguntas">

            @if ($formulario->form_descripcion != '')
            <div class="div-formulario-n">
                <p>{{ $formulario->form_descripcion }}</p>
            </div>
            @endif

            @foreach ($formulario->preguntas as $index => $pregunta)
                @if ($pregunta->tipoPregunta->tipp_id == 1)
                    <div class="div-formulario-n">
                        <h3 class="">{{ $pregunta->pre_pregunta }}</h3>
                        @if ($pregunta->archivosFormulario->count() > 0 || $pregunta->respuesta->archivosFormulario->count() > 0)
                            <div class="color-texto-cbre bottom-20 cursor-pointer small">
                                <i class="far fa-paperclip"></i>
                                <a href="{{ route('formulario-area-tecnica.archivos', [$formulario->form_id, $pregunta->pre_id]) }}"
                                    class="text-decoration-none">Información complementaria</a>
                            </div>
                        @endif
                        @foreach ($pregunta->opciones as $index => $opcion)
                            <div class="row align-center preguntas-preview">
                                @if ($respuestaOpcion->contains('reop_opcion_id', $opcion->opc_id))
                                    <input disabled type="radio" checked>
                                    <p>{{ $opcion->opc_opcion }}</p>
                                @else
                                    <input disabled type="radio">
                                    <p>{{ $opcion->opc_opcion }}</p>
                                @endif
                            </div>
                        @endforeach
                        <div class="opciones-pregunta grid-header-2">
                            <div class="row gap-37 padding-left-15">
                                <div class="modalFile__abrirBtn"
                                    wire:click="uploadFileModalRespuesta({{ $pregunta->pre_id }})">
                                    @if ($pregunta->respuesta)
                                        <i class="far fa-paperclip"></i>
                                        Archivos adjuntos ({{ $pregunta->respuesta->archivosFormulario->count() }})
                                    @else
                                        <i class="far fa-paperclip"></i>
                                        Archivos adjuntos ({{ 0 }})
                                    @endif
                                </div>

                                <div class="row-global align-center agregar-comentario cursor-pointer">
                                    <i class="far fa-comment fa-flip-horizontal"></i>
                                    <p>Comentario</p>
                                </div>

                            </div>
                            <div class="row opciones-extras-formulario">
                                @if ($pregunta->pre_obligatorio == 1)
                                    <p class="color-rojo">Obligatoria</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @elseif ($pregunta->tipoPregunta->tipp_id == 2)
                    <div class="div-formulario-n">
                        <h3 class="">{{ $pregunta->pre_pregunta }}</h3>
                        @if ($pregunta->archivosFormulario->count() > 0 || $pregunta->respuesta->archivosFormulario->count() > 0)
                            <div class="color-texto-cbre bottom-20 cursor-pointer small">
                                <i class="far fa-paperclip"></i>
                                <a href="{{ route('formulario-area-tecnica.archivos', [$formulario->form_id, $pregunta->pre_id]) }}"
                                    class="text-decoration-none">Información complementaria</a>
                            </div>
                        @endif
                        @foreach ($pregunta->opciones as $index => $opcion)
                            <div class="row align-center preguntas-preview">
                                @if ($respuestaOpcion->contains('reop_opcion_id', $opcion->opc_id))
                                    <input disabled type="checkbox" checked>
                                    <p>{{ $opcion->opc_opcion }}</p>
                                @else
                                    <input disabled type="checkbox">
                                    <p>{{ $opcion->opc_opcion }}</p>
                                @endif
                            </div>
                        @endforeach
                        <div class="opciones-pregunta grid-header-2">
                            <div class="row gap-37 padding-left-15">
                                <div class="modalFile__abrirBtn"
                                    wire:click="uploadFileModalRespuesta({{ $pregunta->pre_id }})">
                                    @if ($pregunta->respuesta)
                                        <i class="far fa-paperclip"></i>
                                        Archivos adjuntos ({{ $pregunta->respuesta->archivosFormulario->count() }})
                                    @else
                                        <i class="far fa-paperclip"></i>
                                        Archivos adjuntos ({{ 0 }})
                                    @endif
                                </div>

                                <div class="row-global align-center agregar-comentario cursor-pointer">
                                    <i class="far fa-comment fa-flip-horizontal"></i>
                                    <p>Comentario</p>
                                </div>

                            </div>
                            <div class="row opciones-extras-formulario">
                                @if ($pregunta->pre_obligatorio == 1)
                                    <p class="color-rojo">Obligatoria</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @elseif ($pregunta->tipoPregunta->tipp_id == 3)
                    <div class="div-formulario-n">
                        <h3 class="">{{ $pregunta->pre_pregunta }}</h3>
                        @if ($pregunta->archivosFormulario->count() > 0 || $pregunta->respuesta->archivosFormulario->count() > 0)
                            <div class="color-texto-cbre bottom-20 cursor-pointer small">
                                <i class="far fa-paperclip"></i>
                                <a href="{{ route('formulario-area-tecnica.archivos', [$formulario->form_id, $pregunta->pre_id]) }}"
                                    class="text-decoration-none">Información complementaria</a>
                            </div>
                        @endif
                        <div class="form-group">
                            <textarea name="" id="" class="form-control" cols="30" rows="10" disabled>{{ $pregunta->respuesta->res_parrafo }}</textarea>
                        </div>
                        <div class="opciones-pregunta grid-header-2">
                            <div class="row gap-37 padding-left-15">
                                <div class="modalFile__abrirBtn"
                                    wire:click="uploadFileModalRespuesta({{ $pregunta->pre_id }})">
                                    @if ($pregunta->respuesta)
                                        <i class="far fa-paperclip"></i>
                                        Archivos adjuntos ({{ $pregunta->respuesta->archivosFormulario->count() }})
                                    @else
                                        <i class="far fa-paperclip"></i>
                                        Archivos adjuntos ({{ 0 }})
                                    @endif
                                </div>

                                <div class="row-global align-center agregar-comentario cursor-pointer">
                                    <i class="far fa-comment fa-flip-horizontal"></i>
                                    <p>Comentario</p>
                                </div>

                            </div>
                            <div class="row opciones-extras-formulario">
                                @if ($pregunta->pre_obligatorio == 1)
                                    <p class="color-rojo">Obligatoria</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @elseif ($pregunta->tipoPregunta->tipp_id == 4)
                    <div class="div-formulario-n">
                        <fieldset class="row row-responsive">
                            <div class="col-xl">
                                <div class="form-group">
                                    <h3 class="">{{ $pregunta->pre_pregunta }}</h3>
                                </div>
                                @if ($pregunta->archivosFormulario->count() > 0 || $pregunta->respuesta->archivosFormulario->count() > 0)
                                    <div class="color-texto-cbre bottom-20 cursor-pointer small">
                                        <i class="far fa-paperclip"></i>
                                        <a href="{{ route('formulario-area-tecnica.archivos', [$formulario->form_id, $pregunta->pre_id]) }}"
                                            class="text-decoration-none">Información complementaria</a>
                                    </div>
                                @endif
                            </div>
                        </fieldset>
                        <fieldset class="row row-responsive">

                            <div class="col-sm-4 row-column-global sin-margen">
                                <label for="">Mes de evaluación</label>
                                <div class="form-group">
                                    <select id="" name="" class="form-control" tabindex="4"
                                        style="width:100%;" disabled>
                                        <option value="1">
                                            {{ ucfirst(\Carbon\Carbon::createFromDate(null, $pregunta->respuesta->res_mes)->locale('es')->monthName) }}
                                        </option>
                                    </select>
                                    <small id="" class="field-message-alert absolute"></small>
                                </div>
                            </div>

                            <div class="col-sm-4 row-column-global sin-margen">
                                <label for="">Año</label>
                                <div class="form-group">
                                    <select id="" name="" class="form-control" tabindex="4"
                                        style="width:100%;" disabled>
                                        <option value="1">{{ $pregunta->respuesta->res_ano }}</option>
                                    </select>
                                    <small id="" class="field-message-alert absolute"></small>
                                </div>
                            </div>
                        </fieldset>

                        <h3 class="margin-20">Reporte de accidentabildiad CBRE</h3>

                        <fieldset class="row-global row-responsive">
                            <label class="width-250" for="">Dotación</label>
                            <div class="form-group">
                                <input id="" name="" class="form-control" type="text" tabindex="1"
                                    placeholder="" disabled value="{{ $pregunta->respuesta->res_dotacion }}">
                            </div>
                        </fieldset>

                        <fieldset class="row-global row-responsive">
                            <label class="width-250" for="">Reporte de accidentabildiad</label>
                            <div>
                                @if ($pregunta->respuesta->res_documento_accidentabilidad)
                                <input class="form-control input-file-nuevo" id="" name=""type="file"
                                tabindex="1" disabled>
                                <a href="{{$pregunta->respuesta->getUrlDocumentoAccidentabilidad()}}" target="_blank" class="small">Descargar archivo adjunto</a>
                                    @else
                                    <input class="form-control input-file-nuevo" id="" name=""type="file"
                                    tabindex="1" disabled>
                                @endif

                            </div>
                        </fieldset>

                        <div class="linea-separadora"></div>
                        <h3 class="margin-20">Reporte de accidentabildiad Sub contratos</h3>
                        <fieldset class="row-global row-responsive">
                            <label class="width-250" for="">Dotación sub contratos</label>
                            <div class="form-group">
                                <input id="" name="" class="form-control" type="text" tabindex="1"
                                    placeholder="" disabled
                                    value="{{ $pregunta->respuesta->res_dotacion_sub_contratos }}">
                            </div>
                        </fieldset>

                        <fieldset class="row-global row-responsive">
                            <label class="width-250" for="">¿Cuántos de estos son nuevos?</label>
                            <div class="form-group">
                                <input id="" name="" class="form-control" type="text" tabindex="1"
                                    placeholder="" disabled value="{{ $pregunta->respuesta->res_dotacion_nuevos }}">
                            </div>
                        </fieldset>

                        <fieldset class="row-global row-responsive">
                            <label class="width-250" for="">¿Todos tienen documentación de sub contratación al
                                día?</label>
                            <div class="form-group row-global">
                                @if ($pregunta->respuesta->res_documentacion_sub_contrato)
                                    <div class="row-global align-center">
                                        <input type="radio" name="option" checked disabled>
                                        <p>Si</p>
                                    </div>
                                    <div class="row-global align-center">
                                        <input type="radio" name="" id="" disabled>
                                        <p>No</p>
                                    </div>
                                @else
                                    <div class="row-global align-center">
                                        <input type="radio" name="option" disabled>
                                        <p>Si</p>
                                    </div>
                                    <div class="row-global align-center">
                                        <input type="radio" name="" id="" checked disabled>
                                        <p>No</p>
                                    </div>
                                @endif
                            </div>
                        </fieldset>

                        <fieldset class="row-global row-responsive">
                            <label class="width-250" for="">Subir documentación</label>
                            <div>
                                @if ($pregunta->respuesta->res_documentacion)
                                <input class="form-control input-file-nuevo" id="" name=""type="file"
                                tabindex="1" disabled>
                            <p style="margin-top: 10px !important;">Subir todos los documentos comprimidos en un solo
                                archivo</p>
                                <a href="{{$pregunta->respuesta->getUrlDocumentacion()}}" target="_blank" class="small">Descargar archivo adjunto</a>
                                    @else
                                    <input class="form-control input-file-nuevo" id="" name=""type="file"
                                    tabindex="1" disabled>
                                <p style="margin-top: 10px !important;">Subir todos los documentos comprimidos en un solo
                                    archivo</p>
                                @endif
                            </div>
                        </fieldset>
                        <div class="opciones-pregunta grid-header-2">
                            <div class="row gap-37 padding-left-15">
                                <div class="modalFile__abrirBtn"
                                    wire:click="uploadFileModalRespuesta({{ $pregunta->pre_id }})">
                                    @if ($pregunta->respuesta)
                                        <i class="far fa-paperclip"></i>
                                        Archivos adjuntos ({{ $pregunta->respuesta->archivosFormulario->count() }})
                                    @else
                                        <i class="far fa-paperclip"></i>
                                        Archivos adjuntos ({{ 0 }})
                                    @endif
                                </div>

                                <div class="row-global align-center agregar-comentario cursor-pointer">
                                    <i class="far fa-comment fa-flip-horizontal"></i>
                                    <p>Comentario</p>
                                </div>

                            </div>
                            <div class="row opciones-extras-formulario">
                                @if ($pregunta->pre_obligatorio == 1)
                                    <p class="color-rojo">Obligatoria</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

        </div>

    </div>
@endsection

@push('scripts')
    {{-- <script src="{{ asset('public\js\admin\sistema\caracteristicas\form_agregar.js') }}"></script>
<script src="{{ asset('/public/css/componentes/tab/tab.js') }}"></script>
<script src="{{ asset('/public/css/componentes/modal/modal.js') }}"></script>
<script src="{{ asset('/public/js/script.js') }}"></script> --}}
@endpush
