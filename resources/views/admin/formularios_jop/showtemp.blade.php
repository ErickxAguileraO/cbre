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
    <a href="{{ route('formulario-jop.index') }}" class="row row-responsive link-atras">
        <i class="far fa-arrow-left"></i>
        Volver al listado
    </a>
    <form action="#" method="POST" id="tab1" class="tab__contenido">
        <h1 class="col-xl">Encuesta equipo de limpieza</h1>
        <div class="contenedor-form-preguntas">
            <div class="div-formulario-n">
                <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum
                    deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non
                    provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum
                    fuga.</p>
            </div>


            {{-- Seleccion individual --}}
            <div class="div-formulario-n">
                <div class="contenedor-pregunta">
                    <h3 class="">1. ¿Cuando fue la ultima vez que se realizó mantención al ascensor principal?</h3>
                    <div class="color-texto-cbre bottom-20 cursor-pointer">
                        <i class="far fa-paperclip"></i>
                        Información complementaria
                    </div>
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
                </div>

                {{-- Comentario --}}
                <div class="contenedor-comentario"></div>

                {{-- Opciones de la pregunta --}}
                <div class="opciones-pregunta grid-header-2">
                    <div class="row gap-37 padding-left-15">
                        <div class="modalFile__abrirBtn">
                            <i class="far fa-paperclip"></i>
                            Adjuntar archivos
                        </div>

                        <div class="row-global align-center">
                            <div class="contador-archivos"><p>5</p></div>
                            <p>Archivos adjuntos</p>
                        </div>

                        <div class="row-global align-center agregar-comentario cursor-pointer">
                            <i class="far fa-comment fa-flip-horizontal"></i>
                            <p>Añadir comentario</p>
                        </div>


                    </div>
                    <div class="row opciones-extras-formulario">
                        <p class="color-rojo">Obligatoria</p>
                    </div>
                </div>
            </div>

            {{-- Seleccion multriple --}}
            <div class="div-formulario-n">
                <div class="contenedor-pregunta">
                    <h3 class="">2. ¿Cuando fue la ultima vez que se realizó mantención al ascensor principal?</h3>
                    <div class="color-texto-cbre bottom-20 cursor-pointer">
                        <i class="far fa-paperclip"></i>
                        Información complementaria
                    </div>
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

                {{-- Comentario --}}
                <div class="contenedor-comentario"></div>

                {{-- Opciones de la pregunta --}}
                <div class="opciones-pregunta grid-header-2">
                    <div class="row gap-37 padding-left-15">
                        <div class="modalFile__abrirBtn">
                            <i class="far fa-paperclip"></i>
                            Adjuntar archivos
                        </div>

                        <div class="row-global align-center">
                            <div class="contador-archivos"><p>5</p></div>
                            <p>Archivos adjuntos</p>
                        </div>

                        <div class="row-global align-center agregar-comentario cursor-pointer">
                            <i class="far fa-comment fa-flip-horizontal"></i>
                            <p>Añadir comentario</p>
                        </div>


                    </div>
                    <div class="row opciones-extras-formulario">
                        <p class="color-rojo">Obligatoria</p>
                    </div>
                </div>
            </div>

            {{-- Parrafo --}}
            <div class="div-formulario-n">
                <div class="contenedor-pregunta">
                    <h3 class="">3. ¿Cuando fue la ultima vez que se realizó mantención al ascensor principal?</h3>
                    <div class="color-texto-cbre bottom-20 cursor-pointer">
                        <i class="far fa-paperclip"></i>
                        Información complementaria
                    </div>
                    <div>
                        <textarea name="" id="" class="form-control" cols="30" rows="10"
                            placeholder="Escriba su respuesta aquí"></textarea>
                        <small id="" class="field-message-alert absolute"></small>
                    </div>
                </div>
                {{-- Comentario --}}
                <div class="contenedor-comentario"></div>
                {{-- Opciones de la pregunta --}}
                <div class="opciones-pregunta grid-header-2">
                    <div class="row gap-37 padding-left-15">
                        <div class="modalFile__abrirBtn">
                            <i class="far fa-paperclip"></i>
                            Adjuntar archivos
                        </div>

                        <div class="row-global align-center">
                            <div class="contador-archivos"><p>5</p></div>
                            <p>Archivos adjuntos</p>
                        </div>

                        <div class="row-global align-center agregar-comentario cursor-pointer">
                            <i class="far fa-comment fa-flip-horizontal"></i>
                            <p>Añadir comentario</p>
                        </div>


                    </div>
                    <div class="row opciones-extras-formulario">
                        <p class="color-rojo">Obligatoria</p>
                    </div>
                </div>
            </div>


            {{-- HSE - Accidentabilidad --}}
            <div class="div-formulario-n">
                <div class="contenedor-pregunta">
                    <h3 class="">4. ¿Cuando fue la ultima vez que se realizó mantención al ascensor principal?</h3>
                    <div class="color-texto-cbre bottom-20 cursor-pointer">
                        <i class="far fa-paperclip"></i>
                        Información complementaria
                    </div>

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
                        <div>
                            <input class="form-control input-file-nuevo" id="" name="" type="file" tabindex="1">
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
                        <div>
                            <input class="form-control input-file-nuevo" id="" name="" type="file" tabindex="1">
                            <p style="margin-top: 10px !important;">Subir todos los documentos comprimidos en un solo
                                archivo</p>
                        </div>
                    </fieldset>
                </div>
                {{-- Comentario --}}
                <div class="contenedor-comentario"></div>
                {{-- Opciones pregunta --}}
                <div class="opciones-pregunta grid-header-2">
                    <div class="row gap-37 padding-left-15">
                        <div class="modalFile__abrirBtn">
                            <i class="far fa-paperclip"></i>
                            Adjuntar archivos
                        </div>

                        <div class="row-global align-center">
                            <div class="contador-archivos"><p>5</p></div>
                            <p>Archivos adjuntos</p>
                        </div>

                        <div class="row-global align-center agregar-comentario cursor-pointer">
                            <i class="far fa-comment fa-flip-horizontal"></i>
                            <p>Añadir comentario</p>
                        </div>

                    </div>
                    <div class="row opciones-extras-formulario">
                        <p class="color-rojo">Obligatoria</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="botones-formulario">
            <button class="modalFile__btnN modalFile__botonSecundario">Guardar y seguir mas tarde</button>
            <div class="modalEnviar__abrirBtn modalFile__btnN modalFile__botonPrimario">Enviar formulario</div>
        </div>

        {{-- Modal enviar --}}
        <div class="contenedor__modalEnviar">
            <div class="modalFile">
                <div class="modalFile__header">
                    <h3>Enviar formulario</h3>
                </div>
                <div class="modalFile__contenedorContenido">
                    <h3 style="text-align: center;">¿Estas seguro de enviar el formulario?</h3>
                </div>

                <div class="modalFile__botones">
                    <div class="modalEnviar__cerrarBtn modalFile__btnN modalFile__botonSecundario">Cerrar</div>
                    <button class="modalFile__btnN modalFile__botonPrimario">Guardar</button>
                </div>

            </div>
        </div>

        {{-- Modal archivos --}}
        @include('components.modalFile')



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
