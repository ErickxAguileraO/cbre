@extends('layout.admin')

@section('title', 'Edificios')

@push('stylesheets')
   <link rel="stylesheet" type="text/css" href="{{ asset('public/css/admin/edificios/form-agregar.css') }}">
@endpush

@section('content')
   <h1>Modificar edificio</h1>
   <form action="" id="formEdificio" name="formEdificio" class="formulario">
   @csrf
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
               <label for="descripcionTextarea">Descripción</label>
               <div class="">
                    <div>
                        <textarea name="descripcionTextarea" id="descripcionTextarea"
                            class="form-control texto text-tarea-seccion ckeditor" rows="5" tabindex="2">
                            {{ $edificio->edi_descripcion }}
                        </textarea>
                    </div>
                </div>
               <small id="errorDescripcion" class="field-message-alert invisible absolute"></small>
            </div>
         </div>
      </fieldset>

      <fieldset class="row">
         <div class="col-sm-4">
            <div class="form-group">
               <label for="direccion">Dirección</label>
               <input id="direccion" name="direccion" value="{{ $edificio->edi_direccion }}" class="form-control" type="text" tabindex="3" data-maximo-caracteres="255"/>
               <small id="errorDireccion" class="field-message-alert invisible absolute"></small>
            </div>
         </div>
      </fieldset>    

      <fieldset class="row">
         <div class="col-sm-4">
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
               <label for="imagenesGaleria">Imágenes de la galería</label>
               <div class="d-flex align-items-end">
                  <div class="file-select">
                     <input multiple id="imagenesGaleria" name="imagenesGaleria[]" type="file" class="input-file" lang="es" accept=".jpg,.jpeg,.png" tabindex="5">
                  </div>
                  <div class="archivo-seleccionado px-2">
                     <span class="align-text-bottom">Ningún archivo seleccionado</span>
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
               <input id="video" name="video" value="{{ $edificio->edi_video }}" class="form-control" type="text" tabindex="6" data-maximo-caracteres="255"/>
               <small id="errorVideo" class="field-message-alert invisible absolute"></small>
            </div>
         </div>
      </fieldset>

      <fieldset class="row">
         <div class="col-sm-4">
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
               <label for="ubicacionTitulo">Ubicación</label>
               <input id="ubicacionTitulo" name="ubicacionTitulo" value="{{ $edificio->ubi_titulo }}" class="form-control" type="text" tabindex="8" data-maximo-caracteres="255"/>
               <small id="errorUbicacionTitulo" class="field-message-alert invisible absolute"></small>
            </div>
         </div>
      </fieldset>  

      <fieldset class="row">
         <div class="col-sm-4">
            <div class="form-group">
               <label for="ubicacionDescripcionTextarea">Descripción de la ubicación</label>
               <div class="">
                  <div>
                     <textarea name="ubicacionDescripcionTextarea" id="ubicacionDescripcionTextarea"
                           class="form-control texto text-tarea-seccion ckeditor" rows="5" tabindex="9">
                           {{ $edificio->ubi_descripcion }}
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
               <input id="autocompletadoMap" type="text" class="form-control mb-1" tabindex="10" placeholder="Ingresa una ubicación"/>
               <div id="map"></div>
               <small id="errorAutocompletadoMap" class="field-message-alert invisible absolute"></small>
            </div>
         </div>
      </fieldset>  

      <div class="border-top">
         <div class="py-4 small">Jefe de operaciones</div>
         <fieldset class="row">
            <div class="col-sm-4">
               <div class="form-group">
                  <label for="jefeNombre">Nombre</label>
                  <input id="jefeNombre" name="jefeNombre" value="{{ $edificio->jefeOperaciones->fun_nombre }}" class="form-control" type="text" tabindex="11" data-maximo-caracteres="255"/>
                  <small id="errorJefeNombre" class="field-message-alert invisible absolute"></small>
               </div>
            </div>
         </fieldset>

         <fieldset class="row">
            <div class="col-sm-4">
               <div class="form-group">
                  <label for="jefeApellidos">Apellidos</label>
                  <input id="jefeApellidos" name="jefeApellidos" value="{{ $edificio->jefeOperaciones->fun_apellido }}" class="form-control" type="text" tabindex="12" data-maximo-caracteres="255"/>
                  <small id="errorJefeApellidos" class="field-message-alert invisible absolute"></small>
               </div>
            </div>
         </fieldset>

         <fieldset class="row">
            <div class="col-sm-4">
               <div class="form-group">
                  <label for="jefeEmail">Email</label>
                  <input id="jefeEmail" name="jefeEmail" value="{{ $edificio->jefeOperaciones->user->email }}" class="form-control" type="email" tabindex="12" data-maximo-caracteres="255"/>
                  <small id="errorJefeEmail" class="field-message-alert invisible absolute"></small>
               </div>
            </div>
         </fieldset>

         <fieldset class="row">
            <div class="col-sm-4">
               <div class="form-group">
                  <label for="jefeTelefono">Teléfono</label>
                  <input id="jefeTelefono" name="jefeTelefono" value="{{ $edificio->jefeOperaciones->fun_telefono }}" class="form-control solo-numeros" type="text" tabindex="13" data-maximo-caracteres="9"/>
                  <small id="errorJefeTelefono" class="field-message-alert invisible absolute"></small>
               </div>
            </div>
         </fieldset>

         <fieldset class="row">
            <div class="col-sm-4">
               <div class="form-group">
                  <label for="">Foto</label>
                  <div class="py-2">
                     <img src="{{ $edificio->jefeOperaciones->urlImagen }}" alt="" width="360" height="260">
                  </div>
                  <div class="d-flex align-items-end">
                     <div class="file-select">
                        <input id="fotoJefe" name="fotoJefe" type="file" class="input-file" lang="es" accept=".jpg,.jpeg,.png" tabindex="14">
                     </div>
                     <div class="archivo-seleccionado px-2">
                        <span class="align-text-bottom">Ningún archivo seleccionado</span>
                     </div>
                  </div>
                  <small id="errorFotoJefe" class="field-message-alert invisible"></small>
               </div>
            </div>
         </fieldset>
      </div>

      <div class="border-top">
         <div class="py-4 small">Asistente de operaciones</div>
         <fieldset class="row">
            <div class="col-sm-4">
               <div class="form-group">
                  <label for="asistenteNombre">Nombre</label>
                  <input id="asistenteNombre" name="asistenteNombre" value="{{ $edificio->asistenteOperaciones->fun_nombre }}" class="form-control" type="text" tabindex="15" data-maximo-caracteres="255"/>
                  <small id="errorAsistenteNombre" class="field-message-alert invisible absolute"></small>
               </div>
            </div>
         </fieldset>

         <fieldset class="row">
            <div class="col-sm-4">
               <div class="form-group">
                  <label for="asistenteApellidos">Apellidos</label>
                  <input id="asistenteApellidos" name="asistenteApellidos" value="{{ $edificio->asistenteOperaciones->fun_apellido }}" class="form-control" type="text" tabindex="16" data-maximo-caracteres="255"/>
                  <small id="errorAsistenteApellidos" class="field-message-alert invisible absolute"></small>
               </div>
            </div>
         </fieldset>

         <fieldset class="row">
            <div class="col-sm-4">
               <div class="form-group">
                  <label for="asistenteEmail">Email</label>
                  <input id="asistenteEmail" name="asistenteEmail" value="{{ $edificio->asistenteOperaciones->user->email }}" class="form-control" type="email" tabindex="12" data-maximo-caracteres="255"/>
                  <small id="errorAsistenteEmail" class="field-message-alert invisible absolute"></small>
               </div>
            </div>
         </fieldset>

         <fieldset class="row">
            <div class="col-sm-4">
               <div class="form-group">
                  <label for="asistenteTelefono">Teléfono</label>
                  <input id="asistenteTelefono" name="asistenteTelefono" value="{{ $edificio->jefeOperaciones->fun_telefono }}" class="form-control solo-numeros" type="text" tabindex="17" data-maximo-caracteres="9"/>
                  <small id="errorAsistenteTelefono" class="field-message-alert invisible absolute"></small>
               </div>
            </div>
         </fieldset>

         <fieldset class="row">
            <div class="col-sm-4">
               <div class="form-group">
                  <label for="">Foto</label>
                  <div class="py-2">
                     <img src="{{ $edificio->asistenteOperaciones->urlImagen }}" alt="" width="360" height="260">
                  </div>
                  <div class="d-flex align-items-end">
                     <div class="file-select">
                        <input id="fotoAsistente" name="fotoAsistente" type="file" class="input-file" lang="es" accept=".jpg,.jpeg,.png" tabindex="18">
                     </div>
                     <div class="archivo-seleccionado px-2">
                        <span class="align-text-bottom">Ningún archivo seleccionado</span>
                     </div>
                  </div>
                  <small id="errorFotoAsistente" class="field-message-alert invisible"></small>
               </div>
            </div>
         </fieldset>

         <div class="border-top py-4">
            <fieldset class="row">
               <div class="col-sm-4">
                  <div class="form-group">
                     <label for="certificaciones">Certificaciones</label>
                     <select id="certificaciones" name="certificaciones[]" class="form-control" multiple="multiple" tabindex="19">

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
                     <select id="caracteristicas" name="caracteristicas[]" class="form-control" multiple="multiple" tabindex="20">

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
                  <input id="subdominio" name="subdominio" value="{{ $edificio->edi_subdominio }}" class="form-control solo-letras" type="text" tabindex="15" data-maximo-caracteres="255"/>
                  <small id="errorSubdominio" class="field-message-alert invisible absolute"></small>
               </div>
            </div>
         </fieldset>
         </div>
      </div>
      <br>
      <br>
      <fieldset class="row">
         <div class="col-sm-4">
            <div class="form-group">
               <input id="guardarButton" type="submit" class="btn boton-submit-formulario btn-lg" value="Guardar" />
            </div>
         </div>
      </fieldset>
   </form>
@endsection

@push('scripts')
<script src="{{ asset('public/js/admin/sistema/edificios/form_modificar.js') }}"></script>
<script src="{{ asset('public/js/admin/sistema/edificios/map_ubicacion.js') }}"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initMap"></script>
@endpush
