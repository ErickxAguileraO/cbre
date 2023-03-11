@extends('layout.admin')

@section('title', 'Edificios')

@push('stylesheets')
   <link rel="stylesheet" type="text/css" href="{{ asset('public/css/admin/edificios/form-agregar.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('public/js/admin/jquery/croppie/css/croppie.min.css') }}"/>
@endpush

@section('content')
   <h1>Crear edificio</h1>
   <form action="" id="formEdificio" name="formEdificio" class="formulario">
   @csrf
      <fieldset class="row">
         <div class="col-sm-4">
            <div class="form-group">
               <label for="nombre">Nombre</label>
               <input id="nombre" name="nombre" value="" class="form-control" type="text" tabindex="1" data-maximo-caracteres="255"/>
               <small id="errorNombre" class="field-message-alert invisible absolute"></small>
            </div>
         </div>
      </fieldset>

      <fieldset class="row">
         <div class="col-sm-6">
            <div class="form-group">
               <label for="descripcionTextarea">Descripción</label>
               <div class="">
                    <div>
                        <textarea name="descripcionTextarea" id="descripcionTextarea"class="form-control texto text-tarea-seccion" rows="" tabindex="2"></textarea>
                    </div>
                </div>
               <small id="errorDescripcion" class="field-message-alert invisible absolute"></small>
            </div>
         </div>
      </fieldset>

      <fieldset class="row">
         <div class="col-sm-4">
            <div class="form-group">
               <label for="">Imagen principal</label>
               <div class="d-flex align-items-end">
                  <div class="file-select">
                     <input id="imagenPrincipal" name="imagenPrincipal" type="file" class="input-file" lang="es" accept=".jpg,.jpeg,.png" tabindex="7">
                  </div>
                  <div class="archivo-seleccionado px-2">
                     <span class="align-text-bottom">Ningún archivo seleccionado</span>
                  </div>
               </div>
               <small id="errorImagenPrincipal" class="field-message-alert invisible"></small>
            </div>
         </div>
      </fieldset>

      <fieldset class="row">
         <div class="col-sm-4">
            <div class="form-group">
               <label for="">Imagen del listado</label>
               <div class="d-flex align-items-end">
                  <div class="file-select">
                     <input id="imagenListado" name="imagenListado" type="file" class="input-file" lang="es" accept=".jpg,.jpeg,.png" tabindex="8">
                  </div>
                  <div class="archivo-seleccionado px-2">
                     <span class="align-text-bottom">Ningún archivo seleccionado</span>
                  </div>
               </div>
               <small id="errorImagenListado" class="field-message-alert invisible"></small>
            </div>
         </div>
      </fieldset>

      <fieldset class="row">
         <div class="col-sm-4">
            <div class="form-group">
               <div class="contenedor croppie-container">
                  <label for="" class="pb-4">Imágenes de la galería</label>
                  <div class="imagen1">
                     <div class="container-content my-5">
                           <img class="full default-image-croppie" style="cursor: pointer;" src="{{ asset('public/images/admin/sistema/resizing.png') }}" width="230" title="Agrega una imagen para recortarla."/>
                           <div class="d-none my-4 croppie-image" data-min-width="520" data-min-height="385"></div>
                     </div>
                     <div class="position-relative">
                        <div class="custom-file">
                           <input type="file" id="inputFileGaleria" class="custom-file-input imagen-input" lang="es" accept=".jpg,.jpeg,.png">
                           <label class="custom-file-label" for="imagen-input">Buscar un archivo</label>
                        </div>
                     </div>
                     <div class="modal-footer_imagen" style="text-align:left;margin-top: 15px;">
                        <button type="button" class="btn btn-outline-dark cancel-croppie">Cancelar</button>
                        <button type="button" class="btn btn-outline-success add-image-croppie">Agregar</button>
                     </div>
                     <br>
                     <div class="mt-4 container-gallery">
                        <label class="mb-4">Imagenes cargadas</label>
                        <div class="row images-gallery"></div>
                     </div>
                  </div>
               </div>
               <small id="errorImagenesGaleria" class="field-message-alert invisible"></small>
            </div>
         </div>
      </fieldset>

      <fieldset class="row">
         <div class="col-sm-4">
            <div class="form-group">
               <label for="video">Video</label>
               <input id="video" name="video" value="" class="form-control" type="text" tabindex="9" data-maximo-caracteres="255"/>
               <small id="errorVideo" class="field-message-alert invisible absolute"></small>
            </div>
         </div>
      </fieldset>

      <fieldset class="row">
         <div class="col-sm-4">
            <div class="form-group">
               <label for="submercado">Submercado</label>
               <select id="submercado" name="submercado" class="form-control busqueda-select2" tabindex="10">
                  <option value="">Selecciona...</option>

                  @foreach ($submercados as $submercado)
                  <option value="{{ $submercado->sub_id }}">{{ $submercado->sub_nombre }}</option>
                  @endforeach

               </select>
               <small id="errorSubmercado" class="field-message-alert invisible"></small>
            </div>
         </div>
      </fieldset>

      <fieldset class="row">
         <div class="col-sm-4">
            <div class="form-group">
               <label for="ubicacionTitulo">Título ubicación</label>
               <input id="ubicacionTitulo" name="ubicacionTitulo" value="" class="form-control" type="text" tabindex="11" data-maximo-caracteres="255"/>
               <small id="errorUbicacionTitulo" class="field-message-alert invisible absolute"></small>
            </div>
         </div>
      </fieldset>

      <fieldset class="row">
         <div class="col-sm-6">
            <div class="form-group">
               <label for="ubicacionDescripcionTextarea">Descripción de la ubicación</label>
               <div class="">
                  <div>
                     <textarea name="ubicacionDescripcionTextarea" id="ubicacionDescripcionTextarea"
                           class="form-control texto text-tarea-seccion" rows="5" tabindex="12">
                     </textarea>
                  </div>
               </div>
               <small id="errorUbicacionDescripcion" class="field-message-alert invisible absolute"></small>
            </div>
         </div>
      </fieldset>

      <fieldset class="row">
         <div class="col-sm-4">
            <div class="form-group">
               <input id="autocompletadoMap" type="text" class="form-control mb-1" tabindex="13" placeholder="Ingresa una ubicación"/>
               <div id="map"></div>
               <small id="errorAutocompletadoMap" class="field-message-alert invisible absolute"></small>
            </div>
         </div>
      </fieldset>

      <div class="border-top py-4">
         <fieldset class="row">
            <div class="col-sm-4">
               <div class="form-group">
                  <label for="certificaciones">Certificaciones</label>
                  <select id="certificaciones" name="certificaciones[]" class="form-control" multiple="multiple" tabindex="14">

                     @foreach ($certificaciones as $certificacion)
                     <option value="{{ $certificacion->cer_id }}">{{ $certificacion->cer_nombre }}</option>
                     @endforeach

                  </select>
                  <small id="errorCertificaciones" class="field-message-alert invisible"></small>
               </div>
            </div>
         </fieldset>

         <fieldset class="row">
            <div class="col-sm-4">
               <div class="form-group">
                  <label for="caracteristicas">Características</label>
                  <select id="caracteristicas" name="caracteristicas[]" class="form-control" multiple="multiple" tabindex="15">

                     @foreach ($caracteristicas as $caracteristica)
                     <option value="{{ $caracteristica->car_id }}">{{ $caracteristica->car_nombre }}</option>
                     @endforeach

                  </select>
                  <small id="errorCaracteristicas" class="field-message-alert invisible"></small>
               </div>
            </div>
         </fieldset>

         <fieldset class="row">
            <div class="col-sm-4">
               <div class="form-group">
                  <label for="subdominio">Subdominio</label>
                  <input id="subdominio" name="subdominio" value="" class="form-control solo-letras" type="text" tabindex="16" data-maximo-caracteres="255"/>
                  <small id="errorSubdominio" class="field-message-alert invisible absolute"></small>
               </div>
            </div>
         </fieldset>
      </div>
      @include('admin.components.guardar_btn')
   </form>
@endsection

@push('scripts')
<script src="{{ asset('public/js/admin/sistema/edificios/form_agregar.js') }}"></script>
<script src="{{ asset('public/js/admin/sistema/edificios/google_map_agregar.js') }}"></script>
<script src="{{ asset('public/js/admin/jquery/croppie/js/croppie.min.js') }}"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initMap"></script>
@endpush
