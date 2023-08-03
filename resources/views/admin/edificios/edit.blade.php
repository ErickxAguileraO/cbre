@extends('layout.admin')

@section('title', 'Edificios')

@push('stylesheets')
   <link rel="stylesheet" type="text/css" href="{{ asset('public/css/admin/edificios/form-modificar.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('public/js/admin/jquery/croppie/css/croppie.min.css') }}"  />
@endpush

@section('content')
   <h1>Modificar edificio</h1>
   <form action="" id="formEdificio" name="formEdificio" class="formulario">
   @csrf
   @method('PUT')
      <fieldset class="row">
         <div class="col-sm-4">
            <div class="form-group">
               <label for="nombre">Nombre</label>
               <input id="nombre" name="nombre" value="{{ $edificio->edi_nombre }}" class="form-control" type="text" tabindex="1" data-maximo-caracteres="255"/>
               <small id="errorNombre" class="field-message-alert invisible absolute"></small>
            </div>
         </div>
      </fieldset>

      <fieldset class="row">
        <div class="col-sm-4">
           <div class="form-group">
              <label for="subdominio">Subdominio</label>
              <input id="subdominio" name="subdominio" value="{{ $edificio->edi_subdominio }}" class="form-control solo-letras" type="text" tabindex="15" data-maximo-caracteres="255"/>
              <small id="errorSubdominio" class="field-message-alert invisible absolute"></small>
           </div>
        </div>
     </fieldset>

      <fieldset class="row">
         <div class="col-sm-6">
            <div class="form-group">
               <label for="descripcionTextarea">Descripción</label>
               <div class="">
                    <div>
                        <textarea name="descripcionTextarea" id="descripcionTextarea" class="form-control texto text-tarea-seccion ckeditor" rows="3" tabindex="2">{{ $edificio->edi_descripcion }}</textarea>
                    </div>
                </div>
               <small id="errorDescripcion" class="field-message-alert invisible absolute"></small>
            </div>
         </div>
      </fieldset>

      <fieldset class="row">
        <div class="col-sm-4">
           <div class="form-group">
              <label for="video">Video</label>
              <input id="video" name="video" value="{{ $edificio->edi_video }}" class="form-control" type="text" tabindex="6" data-maximo-caracteres="255"/>
              <small id="errorVideo" class="field-message-alert invisible absolute"></small>
           </div>
        </div>
     </fieldset>

      <fieldset class="row">
         <div class="col-sm-4">
            <div class="hr-sect mb-5"><span class="small text-secondary">&nbsp;Imágenes</span></div>
            <div class="form-group">
               <label for="">Imagen principal</label>
               <div class="py-2">
                  <img src="{{ $edificio->urlImagen }}" alt="" width="360" height="260">
               </div>
               <div class="d-flex align-items-end">
                  <div class="file-select">
                     <input id="imagenPrincipal" name="imagenPrincipal" type="file" class="input-file" lang="es" accept=".jpg,.jpeg,.png" tabindex="4">
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
              <div class="contenedor croppie-container" data-croppie-container="2">
                 <div class="imagen1"><span>Imagen listado (tamaño mínimo 435px X 285px)</span>
                    <div class="container-content my-5">
                          <img class="full default-image-croppie" style="cursor: pointer;" src="{{ asset('public/images/admin/sistema/resizing.png') }}" width="230" />
                          <div class="d-none my-4 croppie-image single-image" data-min-width="435" data-min-height="285"></div>
                    </div>
                    <div class="position-relative">
                       <div class="custom-file">
                          <input type="file" id="inputFileListado" class="custom-file-input imagen-input" lang="es" accept=".jpg,.jpeg,.png">
                          <label class="custom-file-label" for="imagen-input">Buscar un archivo</label>
                       </div>
                    </div>
                    <div class="modal-footer_imagen" style="text-align:left;margin-top: 15px;">
                       <button type="button" class="btn btn-outline-dark cancel-croppie">Cancelar</button>
                       <button type="button" class="btn btn-outline-success add-image-croppie">Agregar</button>
                    </div>
                    <br>
                    <div class="mt-4 container-gallery">
                        <label class="mb-4">Imagen cargada</label>
                       <div class="row images-gallery">
                        <div class="col-sm-6 col-md-4 pb-5">
                            <img src="{{ $edificio->urlImagenListado }}" alt="" class="w-100">
                            <button class="btn btn-danger position-absolute delete-image-croppie" type="button" style="right:20px">
                                <i class="fas fa-trash-alt text-white pointer-none"></i>
                             </button>
                         </div>
                       </div>
                    </div>
                 </div>
              </div>
              <small id="errorImagenListado" class="field-message-alert invisible"></small>
           </div>
        </div>
     </fieldset>

      <fieldset class="row">
         <div class="col-sm-4">
            <div class="hr-sect mb-5"><span class="small text-secondary">&nbsp;Imágenes galeria</span></div>
            <div class="form-group">
               <div class="contenedor croppie-container" data-croppie-container="1">
                  <div class="imagen1"><span>Imágenes de la galería (tamaño mínimo 520px X 385px)</span>
                     <div class="container-content my-5">
                           <img class="full default-image-croppie" style="cursor: pointer;" src="{{ asset('public/images/admin/sistema/resizing.png') }}" width="230" />
                           <div class="d-none my-4 croppie-image" data-min-width="4032" data-min-height="3024"></div>
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
                        <label class="mb-4">Imágenes cargadas</label>
                        <div class="row images-gallery">
                           @foreach ($edificio->imagenes as $imagen)
                           <div class="col-sm-6 col-md-4 pb-5">
                              <input type="hidden" name="idImagenes[]" value="{{ $imagen->ima_id }}" />
                              <img src="{{ $imagen->urlImagen }}" class="w-100" />
                              <button class="btn btn-danger position-absolute delete-image-croppie" type="button" style="right:20px">
                                 <i class="fas fa-trash-alt text-white pointer-none"></i>
                              </button>
                           </div>
                           @endforeach
                        </div>
                     </div>
                  </div>
               </div>
               <small id="errorImagenesGaleria" class="field-message-alert invisible"></small>
            </div>
         </div>
      </fieldset>

      <fieldset class="row">
         <div class="col-sm-4">
            <div class="hr-sect mb-5"><span class="small text-secondary">&nbsp;Ubicación</span></div>
            <div class="form-group">
               <label for="submercado">Submercado</label>
               <select id="submercado" name="submercado" class="form-control busqueda-select2" tabindex="7">
                  <option value="">Selecciona...</option>

                  @foreach ($submercados as $submercado)
                  <option value="{{ $submercado->sub_id }}"
                  {{ $submercado->sub_id == $edificio->submercado->sub_id ? 'selected' : '' }}
                  >
                  {{ $submercado->sub_nombre }}</option>
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
               <input id="ubicacionTitulo" name="ubicacionTitulo" value="{{ $edificio->ubi_titulo }}" class="form-control" type="text" tabindex="8" data-maximo-caracteres="255"/>
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
                     <textarea name="ubicacionDescripcionTextarea" id="ubicacionDescripcionTextarea" class="form-control texto text-tarea-seccion ckeditor" rows="3" tabindex="9">{{ $edificio->ubi_descripcion }}</textarea>
                  </div>
               </div>
               <small id="errorUbicacionDescripcion" class="field-message-alert invisible absolute"></small>
            </div>
         </div>
      </fieldset>

      <fieldset class="row">
         <div class="col-sm-4">
            <div class="form-group">
               <input id="autocompletadoMap" type="text" class="form-control mb-1" tabindex="10" placeholder="Ingresa una ubicación"/>
               <div id="map" data-latitud="{{ $edificio->edi_latitud }}" data-longitud="{{ $edificio->edi_longitud }}"></div>
               <div class="pt-2">
               <span id="direccionRegistrada" data-direccion-registrada="{{ $edificio->edi_direccion }}">Dirección registrada: {{ $edificio->edi_direccion }}</span>
               </div>

            </div>
         </div>
      </fieldset>

      <div class="py-4">
         <fieldset class="row">
            <div class="col-sm-4">
                <div class="hr-sect mb-5"><span class="small text-secondary">&nbsp;Atributos</span></div>
               <div class="form-group">
                  <label for="certificaciones">Certificaciones</label>
                  <select id="certificaciones" name="certificaciones[]" class="form-control" multiple="multiple" tabindex="19">

                     @foreach ($certificaciones as $certificacion)
                     <option value="{{ $certificacion->cer_id }}"
                     {{ in_array($certificacion->cer_id, Arr::pluck($edificio->certificaciones, 'cer_id')) ? 'selected' : '' }}
                     >
                        {{ $certificacion->cer_nombre }}
                     </option>
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
                  <select id="caracteristicas" name="caracteristicas[]" class="form-control" multiple="multiple" tabindex="20">

                     @foreach ($caracteristicas as $caracteristica)
                     <option value="{{ $caracteristica->car_id }}"
                     {{ in_array($caracteristica->car_id, Arr::pluck($edificio->caracteristicas, 'car_id')) ? 'selected' : '' }}
                     >
                        {{ $caracteristica->car_nombre }}
                     </option>
                     @endforeach

                  </select>
                  <small id="errorCaracteristicas" class="field-message-alert invisible"></small>
               </div>
            </div>
         </fieldset>

      </div>
      @include('components.editar_btn')
      <input type="hidden" id="idEdificio" name="idEdificio" data-id-edificio="{{ $edificio->edi_id }}" value="{{ $edificio->edi_id }}">
   </form>
@endsection

@push('scripts')
<script src="{{ asset('public/js/admin/sistema/edificios/form_modificar.js') }}"></script>
<script src="{{ asset('public/js/admin/sistema/edificios/google_map_modificar.js') }}"></script>
<script src="{{ asset('public/js/admin/jquery/croppie/js/croppie.min.js') }}"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initMap"></script>
@endpush
