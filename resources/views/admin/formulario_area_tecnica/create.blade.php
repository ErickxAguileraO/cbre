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
                                    <a href="/preview-formulario" class="row-option"><i class="fas fa-eye"></i> Visualizar</a>
                                    <div class="row-option modalPublicar__abrirBtn"><i class ="fas fa-eye"></i> Publicar y enviar</div>
                                    <div class="row-option"><i class="fas fa-copy"></i> Duplicar</div>
                                    <div class="row-option"><i class="fas fa-trash-alt"></i> Eliminar</div>
                                    <div class="row-option modalObservacion__abrirBtn"><i class="fas fa-edit"></i> Observación</div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="contenedor-form-preguntas">
                    <div class="div-formulario-n">
                        <h3>Información del formulario</h3>
                        <fieldset class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">Nombre formulario</label>
                                    <input id="" name="" class="form-control" type="text" tabindex="1" />
                                    <small id="" class="field-message-alert absolute"></small>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="row">
                            <div class="col-xl">
                                <div class="form-group">
                                    <label for="">Descripción</label>
                                    <textarea name="" id="" class="form-control" cols="30" rows="10"></textarea>
                                    <small id="" class="field-message-alert absolute"></small>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    {{-- Seleccion individual --}}
                    <div class="div-formulario-n">
                        {{-- Encabezado de pregunta --}}
                        <fieldset class="row row-responsive">
                            <div class="col-xl">
                                <div class="form-group">
                                    <input id="" name="" class="form-control" type="text" tabindex="1" placeholder="Pregunta"/>
                                    <small id="" class="field-message-alert absolute"></small>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <select id="" name="" class="form-control" tabindex="4" style="width:100%;">
                                       <option value="1">Seleccion individual</option>
                                    </select>
                                    <small id="" class="field-message-alert absolute"></small>
                                </div>
                            </div>
                        </fieldset>
                        {{-- Input dinamico --}}
                        <div class="contenedor-dinamico">
                            <fieldset class="row row-input-form">
                                <input type="radio">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <input id="" name="" class="form-control" type="text" tabindex="1" placeholder="Pregunta"/>
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        <div class="btn-agregar row-global cursor-pointer color-texto-cbre">
                            <i class="far fa-plus-circle"></i>
                            <p>Añadir otra opción</p>
                        </div>

                        {{-- Opciones de la pregunta --}}
                        <div class="opciones-pregunta grid-header-2">
                            <div class="modalFile__abrirBtn">
                                <i class="far fa-paperclip"></i>
                                Adjuntar archivos
                            </div>
                            <div class="row opciones-extras-formulario">
                                <div class="row-global align-center">
                                    <p>Obligatorio</p>

                                    <label class="switch">
                                        <input type="checkbox" codigo="">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                                <div class="btn-remove-pregunta">
                                    <p>Eliminar pregunta</p>
                                    <img src="/public/images/admin/sistema/delete.svg" class="btn-remove" alt="">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Parrafo --}}
                    <div class="div-formulario-n">
                        {{-- Encabezado de pregunta --}}
                        <fieldset class="row row-responsive">
                            <div class="col-xl">
                                <div class="form-group">
                                    <input id="" name="" class="form-control" type="text" tabindex="1" placeholder="Pregunta"/>
                                    <small id="" class="field-message-alert absolute"></small>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <select id="" name="" class="form-control" tabindex="4" style="width:100%;">
                                       <option value="1">Parrafo</option>
                                    </select>
                                    <small id="" class="field-message-alert absolute"></small>
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-group">
                            <textarea name="" id="" class="form-control" cols="30" rows="10"></textarea>
                            <small id="" class="field-message-alert absolute"></small>
                        </div>

                        {{-- Opciones de la pregunta --}}
                        <div class="opciones-pregunta grid-header-2">
                            <div class="modalFile__abrirBtn">
                                <i class="far fa-paperclip"></i>
                                Adjuntar archivos
                            </div>
                            <div class="row opciones-extras-formulario">
                                <div class="row-global align-center">
                                    <p>Obligatorio</p>

                                    <label class="switch">
                                        <input type="checkbox" codigo="">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                                <div class="btn-remove-pregunta">
                                    <p>Eliminar pregunta</p>
                                    <img src="/public/images/admin/sistema/delete.svg" class="btn-remove" alt="">
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- Seleccion multiple --}}
                    <div class="div-formulario-n">
                        {{-- Encabezado de pregunta --}}
                        <fieldset class="row row-responsive">
                            <div class="col-xl">
                                <div class="form-group">
                                    <input id="" name="" class="form-control" type="text" tabindex="1" placeholder="Pregunta"/>
                                    <small id="" class="field-message-alert absolute"></small>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <select id="" name="" class="form-control" tabindex="4" style="width:100%;">
                                       <option value="1">Seleccion múltiple</option>
                                    </select>
                                    <small id="" class="field-message-alert absolute"></small>
                                </div>
                            </div>
                        </fieldset>
                        {{-- Input dinamico --}}
                        <div class="contenedor-dinamico">
                            <fieldset class="row row-input-form">
                                <input type="checkbox">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <input id="" name="" class="form-control" type="text" tabindex="1" placeholder="Pregunta"/>
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        <div class="btn-agregar-2 row-global cursor-pointer color-texto-cbre">
                            <i class="far fa-plus-circle"></i>
                            <p>Añadir otra opción</p>
                        </div>

                        {{-- Opciones de la pregunta --}}
                        <div class="opciones-pregunta grid-header-2">
                            <div class="modalFile__abrirBtn">
                                <i class="far fa-paperclip"></i>
                                Adjuntar archivos
                            </div>
                            <div class="row opciones-extras-formulario">
                                <div class="row-global align-center">
                                    <p>Obligatorio</p>

                                    <label class="switch">
                                        <input type="checkbox" codigo="">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                                <div class="btn-remove-pregunta">
                                    <p>Eliminar pregunta</p>
                                    <img src="/public/images/admin/sistema/delete.svg" class="btn-remove" alt="">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- HSE - Accidentabilidad --}}
                    <div class="div-formulario-n">
                        {{-- Encabezado de pregunta --}}
                        <fieldset class="row row-responsive">
                            <div class="col-xl">
                                <div class="form-group">
                                    <input id="" name="" class="form-control" type="text" tabindex="1" placeholder="Pregunta"/>
                                    <small id="" class="field-message-alert absolute"></small>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <select id="" name="" class="form-control" tabindex="4" style="width:100%;">
                                       <option value="1">HSE - Accidentabilidad</option>
                                    </select>
                                    <small id="" class="field-message-alert absolute"></small>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="row row-responsive">

                            <div class="col-sm-4 row-column-global sin-margen">
                                <label for="">Mes de evaluación</label>
                                <div class="form-group">
                                    <select id="" name="" class="form-control" tabindex="4" style="width:100%;">
                                       <option value="1">Seleccione</option>
                                    </select>
                                    <small id="" class="field-message-alert absolute"></small>
                                </div>
                            </div>

                            <div class="col-sm-4 row-column-global sin-margen">
                                <label for="">Año</label>
                                <div class="form-group">
                                    <select id="" name="" class="form-control" tabindex="4" style="width:100%;">
                                       <option value="1">Seleccione</option>
                                    </select>
                                    <small id="" class="field-message-alert absolute"></small>
                                </div>
                            </div>
                        </fieldset>

                        <h3 class="margin-20">Reporte de accidentabildiad CBRE</h3>

                        <fieldset class="row-global row-responsive">
                            <label class="width-250" for="">Dotación</label>
                            <div class="form-group">
                                <input id="" name="" class="form-control" type="text" tabindex="1" placeholder="">
                            </div>
                        </fieldset>

                        <fieldset class="row-global row-responsive">
                            <label class="width-250" for="">Reporte de accidentabildiad</label>
                            <div >
                                <input class="form-control input-file-nuevo"  id="" name=""type="file" tabindex="1">
                            </div>
                        </fieldset>

                        <div class="linea-separadora"></div>
                        <h3 class="margin-20">Reporte de accidentabildiad Sub contratos</h3>
                        <fieldset class="row-global row-responsive">
                            <label class="width-250" for="">Dotación sub contratos</label>
                            <div class="form-group">
                                <input id="" name="" class="form-control" type="text" tabindex="1" placeholder="">
                            </div>
                        </fieldset>

                        <fieldset class="row-global row-responsive">
                            <label class="width-250" for="">¿Cuántos de estos son nuevos?</label>
                            <div class="form-group">
                                <input id="" name="" class="form-control" type="text" tabindex="1" placeholder="">
                            </div>
                        </fieldset>

                        <fieldset class="row-global row-responsive">
                            <label class="width-250" for="">¿Todos tienen documentación de sub contratación al día?</label>
                            <div class="form-group row-global">
                                <div class="row-global align-center">
                                    <input type="radio" name="" id="">
                                    <p>Si</p>
                                </div>
                                <div class="row-global align-center">
                                    <input type="radio" name="" id="">
                                    <p>No</p>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="row-global row-responsive">
                            <label class="width-250" for="">Subir documentación</label>
                            <div >
                                <input class="form-control input-file-nuevo"  id="" name=""type="file" tabindex="1">
                                <p style="margin-top: 10px !important;">Subir todos los documentos comprimidos en un solo archivo</p>
                            </div>
                        </fieldset>

                        <div class="opciones-pregunta grid-header-2">
                            <div class="modalFile__abrirBtn">
                                <i class="far fa-paperclip"></i>
                                Adjuntar archivos
                            </div>
                            <div class="row opciones-extras-formulario">
                                <div class="row-global align-center">
                                    <p>Obligatorio</p>

                                    <label class="switch">
                                        <input type="checkbox" codigo="">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                                <div class="btn-remove-pregunta">
                                    <p>Eliminar pregunta</p>
                                    <img src="/public/images/admin/sistema/delete.svg" class="btn-remove" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="btn-agregar-nueva-pregunta">
                    <i class="far fa-plus-circle"></i>
                    <p>Agregar nueva pregunta</p>
                </div>

                <div class="linea-separadora"></div>
                <div class="botones-formulario">
                    <button class="modalFile__cerrarBtn modalFile__btnN modalFile__botonSecundario">cancelar</button>
                    <button class="modalFile__btnN modalFile__botonPrimario">Guardar borrador</button>
                </div>



                {{-- Modal archivos --}}
                @include('components.modalFile')



                {{-- Modal Publicar --}}
                @include('components.modalPublicar')

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
    @include('components.modalObservacion')
@endsection

@push('scripts')
    <script src="{{ asset('public\js\admin\sistema\caracteristicas\form_agregar.js') }}"></script>
    <script src="{{ asset('/public/css/componentes/tab/tab.js') }}"></script>
    <script src="{{ asset('/public/css/componentes/modal/modal.js') }}"></script>
    <script src="{{ asset('/public/js/script.js') }}"></script>

@endpush
