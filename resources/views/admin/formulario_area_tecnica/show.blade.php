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

        <div class="tab">

            <ul class="tab__lista-botones">
                <li class="tab__boton" onclick="mostrarTab(event, 'tab1')" style="border-radius: 8px 0px 0px 8px;">
                    <p class="tab__nombre">Formulario</p>
                </li>

                <li class="tab__boton" onclick="mostrarTab(event, 'tab2')" style="border-radius: 0px 8px 8px 0px;">
                    <p class="tab__nombre">Historial</p>
                </li>
            </ul>

            <div id="tab1" class="tab__contenido">
                <div class="grid-header-2">
                        <h1 class="col-xl">{{ $formulario->form_nombre }}</h1>
                    <div class="row datos-formulario">
                            @if (auth()->user()->hasRole('funcionario'))
                                <a href="{{ route('formulario-jop.index') }}" class="estado-formulario">Salir del modo
                                    previsualizar</a>
                            @else
                                <a href="{{ route('formulario-area-tecnica.index') }}" class="estado-formulario">Salir del modo
                                    previsualizar</a>
                                <div class="form-group">
                                    <div class="select-manual">
                                        <p>Opciones</p>
                                        <i class="fas fa-sort-down color-texto-cbre menos-top"></i>
                                        <div class="option-select-manual">
                                            <a href="{{ route('formulario-area-tecnica.duplicar.formulario', $formulario->form_id) }}"
                                                target="_blank" class="row-option"><i class="fas fa-copy"></i> Duplicar</a>
                                                @if (isset($estado) && $estado->foredi_estado == 2)
                                                    <div class="row-option modalObservacion__abrirBtn"><i class="fas fa-edit"></i>
                                                    Observación</div>
                                                @endif
                                            <div class="row-option"><i class="fa-solid fa-right-from-bracket"></i> Cerrar </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                    </div>
                </div>

                @if (isset($respuestas))
                {{--             Contenedor con la estructura del formulario y sus respuestas --}}
                <div class="contenedor-form-preguntas">

                    @if ($formulario->form_descripcion != '')
                        <div class="div-formulario-n">
                            <p>{{ $formulario->form_descripcion }}</p>
                        </div>
                    @endif

                    @foreach ($respuestas as $index => $respuesta)
                        @if ($respuesta->pregunta->tipoPregunta->tipp_id == 1)
                            <div class="div-formulario-n">
                                <h3 class="">{{ $respuesta->pregunta->pre_pregunta }}</h3>
                                @if ($respuesta->archivosFormulario->count() > 0)
                                    <div class="color-texto-cbre bottom-20 cursor-pointer small">
                                        <i class="far fa-paperclip"></i>
                                        <a href="{{ route('formulario-area-tecnica.archivos', [$formulario->form_id, $respuesta->pregunta->pre_id]) }}"
                                            class="text-decoration-none">Información complementaria</a>
                                    </div>
                                @endif
                                @foreach ($respuesta->pregunta->opciones as $index => $opcion)
                                    <div class="row align-center preguntas-preview">
                                        @if (
                                            $respuestaOpcion->contains('reop_opcion_id', $opcion->opc_id) &&
                                                $respuestaOpcion->contains('reop_respuesta_id', $respuesta->res_id))
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
                                            wire:click="uploadFileModalRespuesta({{ $respuesta->pregunta->pre_id }})">
                                            @if ($respuesta)
                                                <i class="far fa-paperclip"></i>
                                                Archivos adjuntos ({{ $respuesta->archivosFormulario->count() }})
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
                                        @if ($respuesta->pregunta->pre_obligatorio == 1)
                                            <p class="color-rojo">Obligatoria</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @elseif ($respuesta->pregunta->tipoPregunta->tipp_id == 2)
                            <div class="div-formulario-n">
                                <h3 class="">{{ $respuesta->pregunta->pre_pregunta }}</h3>
                                @if ($respuesta->archivosFormulario->count() > 0)
                                    <div class="color-texto-cbre bottom-20 cursor-pointer small">
                                        <i class="far fa-paperclip"></i>
                                        <a href="{{ route('formulario-area-tecnica.archivos', [$formulario->form_id, $pregunta->pre_id]) }}"
                                            class="text-decoration-none">Información complementaria</a>
                                    </div>
                                @endif
                                @foreach ($respuesta->pregunta->opciones as $index => $opcion)
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
                                            wire:click="uploadFileModalRespuesta({{ $respuesta->pregunta->pre_id }})">
                                            @if ($respuesta)
                                                <i class="far fa-paperclip"></i>
                                                Archivos adjuntos ({{ $respuesta->archivosFormulario->count() }})
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
                                        @if ($respuesta->pregunta->pre_obligatorio == 1)
                                            <p class="color-rojo">Obligatoria</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @elseif ($respuesta->pregunta->tipoPregunta->tipp_id == 3)
                            <div class="div-formulario-n">
                                <h3 class="">{{ $respuesta->pregunta->pre_pregunta }}</h3>
                                @if ($respuesta->archivosFormulario->count() > 0)
                                    <div class="color-texto-cbre bottom-20 cursor-pointer small">
                                        <i class="far fa-paperclip"></i>
                                        <a href="{{ route('formulario-area-tecnica.archivos', [$formulario->form_id, $respuesta->pregunta->pre_id]) }}"
                                            class="text-decoration-none">Información complementaria</a>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <textarea name="" id="" class="form-control" cols="30" rows="10" disabled>{{ $respuesta->res_parrafo }}</textarea>
                                </div>
                                <div class="opciones-pregunta grid-header-2">
                                    <div class="row gap-37 padding-left-15">
                                        <div class="modalFile__abrirBtn"
                                            wire:click="uploadFileModalRespuesta({{ $respuesta->pregunta->pre_id }})">
                                            @if ($respuesta)
                                                <i class="far fa-paperclip"></i>
                                                Archivos adjuntos ({{ $respuesta->archivosFormulario->count() }})
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
                                        @if ($respuesta->pregunta->pre_obligatorio == 1)
                                            <p class="color-rojo">Obligatoria</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @elseif ($respuesta->pregunta->tipoPregunta->tipp_id == 4)
                            <div class="div-formulario-n">
                                <fieldset class="row row-responsive">
                                    <div class="col-xl">
                                        <div class="form-group">
                                            <h3 class="">{{ $respuesta->pregunta->pre_pregunta }}</h3>
                                        </div>
                                        @if ($respuesta->archivosFormulario->count() > 0)
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
                                                    {{ ucfirst(\Carbon\Carbon::createFromDate(null, $respuesta->res_mes)->locale('es')->monthName) }}
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
                                                <option value="1">{{ $respuesta->res_ano }}</option>
                                            </select>
                                            <small id="" class="field-message-alert absolute"></small>
                                        </div>
                                    </div>
                                </fieldset>

                                <h3 class="margin-20">Reporte de accidentabildiad CBRE</h3>

                                <fieldset class="row-global row-responsive">
                                    <label class="width-250" for="">Dotación</label>
                                    <div class="form-group">
                                        <input id="" name="" class="form-control" type="text"
                                            tabindex="1" placeholder="" disabled
                                            value="{{ $respuesta->res_dotacion }}">
                                    </div>
                                </fieldset>

                                <fieldset class="row-global row-responsive">
                                    <label class="width-250" for="">Reporte de accidentabildiad</label>
                                    <div>
                                        @if ($respuesta->res_documento_accidentabilidad)
                                            <input class="form-control input-file-nuevo" id=""
                                                name=""type="file" tabindex="1" disabled>
                                            <a href="{{ $respuesta->getUrlDocumentoAccidentabilidad() }}" target="_blank"
                                                class="small">Descargar archivo adjunto</a>
                                        @else
                                            <input class="form-control input-file-nuevo" id=""
                                                name=""type="file" tabindex="1" disabled>
                                        @endif

                                    </div>
                                </fieldset>

                                <div class="linea-separadora"></div>
                                <h3 class="margin-20">Reporte de accidentabildiad Sub contratos</h3>
                                <fieldset class="row-global row-responsive">
                                    <label class="width-250" for="">Dotación sub contratos</label>
                                    <div class="form-group">
                                        <input id="" name="" class="form-control" type="text"
                                            tabindex="1" placeholder="" disabled
                                            value="{{ $respuesta->res_dotacion_sub_contratos }}">
                                    </div>
                                </fieldset>

                                <fieldset class="row-global row-responsive">
                                    <label class="width-250" for="">¿Cuántos de estos son nuevos?</label>
                                    <div class="form-group">
                                        <input id="" name="" class="form-control" type="text"
                                            tabindex="1" placeholder="" disabled
                                            value="{{ $respuesta->res_dotacion_nuevos }}">
                                    </div>
                                </fieldset>

                                <fieldset class="row-global row-responsive">
                                    <label class="width-250" for="">¿Todos tienen documentación de sub
                                        contratación al
                                        día?</label>
                                    <div class="form-group row-global">
                                        @if ($respuesta->res_documentacion_sub_contrato)
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

                                @if ($respuesta->res_documentacion)
                                    <fieldset class="row-global row-responsive">
                                        <label class="width-250" for="">Subir documentación</label>
                                        <div>
                                            <input class="form-control input-file-nuevo" id=""
                                                name=""type="file" tabindex="1" disabled>
                                            <p style="margin-top: 10px !important;">Subir todos los documentos comprimidos
                                                en
                                                un
                                                solo
                                                archivo</p>
                                            <a href="{{ $respuesta->getUrlDocumentacion() }}" target="_blank"
                                                class="small">Descargar archivo adjunto</a>
                                        </div>
                                    </fieldset>
                                @endif

                                <div class="opciones-pregunta grid-header-2">
                                    <div class="row gap-37 padding-left-15">
                                        <div class="modalFile__abrirBtn"
                                            wire:click="uploadFileModalRespuesta({{ $respuesta->pregunta->pre_id }})">
                                            @if ($respuesta)
                                                <i class="far fa-paperclip"></i>
                                                Archivos adjuntos ({{ $respuesta->archivosFormulario->count() }})
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
                                        @if ($respuesta->pregunta->pre_obligatorio == 1)
                                            <p class="color-rojo">Obligatoria</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>
            @else
                {{--                 Contenedor solo con la estructura del formulario (sin respuestas) --}}
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
                                @if ($pregunta->archivosFormulario->count() > 0)
                                    <div class="color-texto-cbre bottom-20 cursor-pointer small">
                                        <i class="far fa-paperclip"></i>
                                        <a href="{{ route('formulario-area-tecnica.archivos', [$formulario->form_id, $pregunta->pre_id]) }}"
                                            class="text-decoration-none">Información complementaria</a>
                                    </div>
                                @endif
                                @foreach ($pregunta->opciones as $index => $opcion)
                                    <div class="row align-center preguntas-preview">
                                        <input disabled type="radio">
                                        <p>{{ $opcion->opc_opcion }}</p>
                                    </div>
                                @endforeach
                                <div class="opciones-pregunta grid-header-2">
                                    <div class="row gap-37 padding-left-15">
                                        <div class="modalFile__abrirBtn"
                                            wire:click="uploadFileModalRespuesta({{ $pregunta->pre_id }})">
                                            <i class="far fa-paperclip"></i>
                                            Archivos adjuntos ({{ 0 }})
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
                                @if ($pregunta->archivosFormulario->count() > 0)
                                    <div class="color-texto-cbre bottom-20 cursor-pointer small">
                                        <i class="far fa-paperclip"></i>
                                        <a href="{{ route('formulario-area-tecnica.archivos', [$formulario->form_id, $pregunta->pre_id]) }}"
                                            class="text-decoration-none">Información complementaria</a>
                                    </div>
                                @endif
                                @foreach ($pregunta->opciones as $index => $opcion)
                                    <div class="row align-center preguntas-preview">
                                        <input disabled type="checkbox">
                                        <p>{{ $opcion->opc_opcion }}</p>
                                    </div>
                                @endforeach
                                <div class="opciones-pregunta grid-header-2">
                                    <div class="row gap-37 padding-left-15">
                                        <div class="modalFile__abrirBtn"
                                            wire:click="uploadFileModalRespuesta({{ $pregunta->pre_id }})">
                                            <i class="far fa-paperclip"></i>
                                            Archivos adjuntos ({{ 0 }})
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
                                @if ($pregunta->archivosFormulario->count() > 0)
                                    <div class="color-texto-cbre bottom-20 cursor-pointer small">
                                        <i class="far fa-paperclip"></i>
                                        <a href="{{ route('formulario-area-tecnica.archivos', [$formulario->form_id, $pregunta->pre_id]) }}"
                                            class="text-decoration-none">Información complementaria</a>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <textarea name="" id="" class="form-control" cols="30" rows="10" disabled></textarea>
                                </div>
                                <div class="opciones-pregunta grid-header-2">
                                    <div class="row gap-37 padding-left-15">
                                        <div class="modalFile__abrirBtn"
                                            wire:click="uploadFileModalRespuesta({{ $pregunta->pre_id }})">
                                            <i class="far fa-paperclip"></i>
                                            Archivos adjuntos ({{ 0 }})
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
                                        @if ($pregunta->archivosFormulario->count() > 0)
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
                                                <option value="">Seleccione</option>
                                            </select>
                                            <small id="" class="field-message-alert absolute"></small>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 row-column-global sin-margen">
                                        <label for="">Año</label>
                                        <div class="form-group">
                                            <select id="" name="" class="form-control" tabindex="4"
                                                style="width:100%;" disabled>
                                                <option value="">Seleccione</option>
                                            </select>
                                            <small id="" class="field-message-alert absolute"></small>
                                        </div>
                                    </div>
                                </fieldset>

                                <h3 class="margin-20">Reporte de accidentabildiad CBRE</h3>

                                <fieldset class="row-global row-responsive">
                                    <label class="width-250" for="">Dotación</label>
                                    <div class="form-group">
                                        <input id="" name="" class="form-control" type="text"
                                            tabindex="1" placeholder="" disabled>
                                    </div>
                                </fieldset>

                                <fieldset class="row-global row-responsive">
                                    <label class="width-250" for="">Reporte de accidentabildiad</label>
                                    <div>
                                        <input class="form-control input-file-nuevo" id=""
                                            name=""type="file" tabindex="1" disabled>
                                    </div>
                                </fieldset>

                                <div class="linea-separadora"></div>
                                <h3 class="margin-20">Reporte de accidentabildiad Sub contratos</h3>
                                <fieldset class="row-global row-responsive">
                                    <label class="width-250" for="">Dotación sub contratos</label>
                                    <div class="form-group">
                                        <input id="" name="" class="form-control" type="text"
                                            tabindex="1" placeholder="" disabled>
                                    </div>
                                </fieldset>

                                <fieldset class="row-global row-responsive">
                                    <label class="width-250" for="">¿Cuántos de estos son nuevos?</label>
                                    <div class="form-group">
                                        <input id="" name="" class="form-control" type="text"
                                            tabindex="1" placeholder="" disabled>
                                    </div>
                                </fieldset>

                                <fieldset class="row-global row-responsive">
                                    <label class="width-250" for="">¿Todos tienen documentación de sub
                                        contratación al
                                        día?</label>
                                    <div class="form-group row-global">
                                        <div class="row-global align-center">
                                            <input type="radio" name="option" disabled>
                                            <p>Si</p>
                                        </div>
                                        <div class="row-global align-center">
                                            <input type="radio" name="" id="" disabled>
                                            <p>No</p>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset class="row-global row-responsive">
                                    <label class="width-250" for="">Subir documentación</label>
                                    <div>
                                        <input class="form-control input-file-nuevo" id=""
                                            name=""type="file" tabindex="1" disabled>
                                        <p style="margin-top: 10px !important;">Subir todos los documentos comprimidos en
                                            un
                                            solo
                                            archivo</p>
                                    </div>
                                </fieldset>

                                <div class="opciones-pregunta grid-header-2">
                                    <div class="row gap-37 padding-left-15">
                                        <div class="modalFile__abrirBtn"
                                            wire:click="uploadFileModalRespuesta({{ $pregunta->pre_id }})">
                                            <i class="far fa-paperclip"></i>
                                            Archivos adjuntos ({{ 0 }})
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
            @endif
{{--                 Fin del contenido del formulario --}}
            </div>

            <div id="tab2" class="tab__contenido">
                <h1 class="col-xl">Historial formulario</h1>
                    <div class="div-formulario-n">
                        @if (isset($historiales))
                            <div class="historial">
                                <div class="historial__linea">
                                </div>
                                <div class="historial__datos sin-margen">
                                    <p>{{ $formulario->created_at }}</p>
                                    <h3>Creación de formulario</h3>
                                    <p>Estado: Borrador</p>
                                    <p>Creado por: {{ $formulario->funcionario->fun_nombre }}</p>
                                </div>
                            </div>
                            @foreach ($historiales as $key => $historial)
                                <div class="historial">
                                    <div class="historial__linea">
                                        <div class="{{ $loop->last ? 'historial__lineaCirculo' : '' }}"></div>
                                    </div>
                                    <div class="historial__datos sin-margen">
                                        <p>{{ $historial->created_at }}</p>
                                        <h3>{{ $historial->his_accion }}</h3>
                                        <p>Estado: {{ $historial->his_estado }}</p>
                                        <p>{{ $historial->his_accion }} por: {{ $historial->his_usuario }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="historial">
                                <div class="historial__linea">
                                    <div class="historial__lineaCirculo"></div>
                                </div>
                                <div class="historial__datos sin-margen">
                                    <p>{{ $formulario->created_at }}</p>
                                    <h3>Creación de formulario</h3>
                                    <p>Estado: Borrador</p>
                                    <p>Creado por: {{ $formulario->funcionario->fun_nombre }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
            </div>
        </div>
    </div>

    {{-- Modal observacion --}}
         @include('components.modalObservacion')
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
    <script src="{{ asset('/public/css/componentes/tab/tab.js') }}"></script>
@endpush
