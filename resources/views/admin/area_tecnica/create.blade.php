@extends('layout.admin')
@section('title', 'Crear formulario')
@section('content')
    @push('stylesheets')
      <link rel="stylesheet" href="{{ asset('/public/css/componentes/tab/tab.css') }}">
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
                                <p class="margin-top-5">Opciones</p>
                                <i class="fas fa-sort-down color-texto-cbre menos-top"></i>

                                <div class="option-select-manual">
                                    <a href="" class="row-option"><i class="fas fa-eye"></i> Visualizar</a>
                                    <div class="row-option"><i class="fas fa-eye"></i> Publicar y enviar</div>
                                    <div class="row-option"><i class="fas fa-copy"></i> Duplicar</div>
                                    <div class="row-option"><i class="fas fa-trash-alt"></i> Eliminar</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="div-formulario-n">
                    <h3>Información del formulario</h3>
                    <fieldset class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">Nombre formulario</label>
                                <input id="" name="" class="form-control" data-maximo-caracteres="" type="text" tabindex="1" />
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

                <div class="div-formulario-n">
                    {{-- Encabezado de pregunta --}}
                    <fieldset class="row row-responsive">
                        <div class="col-xl">
                            <div class="form-group">
                                <input id="" name="" class="form-control" data-maximo-caracteres="" type="text" tabindex="1" placeholder="Pregunta"/>
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
                                    <input id="" name="" class="form-control" data-maximo-caracteres="" type="text" tabindex="1" placeholder="Pregunta"/>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    
                    <div id="btn-agregar" class="row-global cursor-pointer color-texto-cbre">
                        <i class="far fa-plus-circle"></i>
                        <p>Añadir otra opción</p>
                    </div>

                    {{-- Opciones de la pregunta --}}
                    <div class="opciones-pregunta grid-header-2">
                        <div class="modal-archivos">
                            <i class="far fa-paperclip"></i>
                            Adjuntar archivos
                        </div>
                        <div class="row datos-formulario">
                            <div>
                                Obligatorio
                            </div>
                            <div>
                                Eliminar pregunta
                                <img src="/public/images/admin/sistema/delete.svg" class="btn btn-remove" alt="">
                            </div>
                        </div>
                    </div>
                    {{-- <div class="form-group">
                        <label for="imagen">Imagen</label>
                        <div class="d-flex align-items-end">
                            <div class="file-select">
                                <input type="file" class="input-file imagen-input" id="imagen" name="imagen"
                                lang="es" accept=".jpg,.jpeg,.png,.svg">
                            </div>
                            <div class="archivo-seleccionado px-2">
                               <span class="align-text-bottom">Ningún archivo seleccionado</span>
                            </div>
                         </div>
                         <small id="imagen_error" class="field-message-alert absolute"></small>
                    </div> --}}
                </div>

            </form>
        
            <div id="tab2" class="tab__contenido">
                <h3>TAB 2</h3>
                <p>earum sapiente! Fuga ab vel, est cum, consectetur quos aliquam quaerat, a explicabo illum eum!</p>
            </div>
        </div>


        
        @include('components.guardar_btn')
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('public\js\admin\sistema\caracteristicas\form_agregar.js') }}"></script>
    <script src="{{ asset('/public/css/componentes/tab/tab.js') }}"></script>
    <script src="{{ asset('/public/js/script.js') }}"></script>

@endpush
