@extends('layout.admin')

@section('title', 'Certificaciones')

@section('content')
   <h1>Modificar certificación</h1>
   <form action="" id="formCertificacion" name="formCertificacion" class="formulario">
   @csrf
   @method('PUT')
      <fieldset class="row">
         <div class="col-sm-4">
            <div class="form-group">
               <label for="nombre">Nombre</label>
               <input id="nombre" name="nombre" value="{{ $certificacion->cer_nombre }}" class="form-control" type="text" tabindex="1" data-maximo-caracteres="255"/>
               <small id="errorNombre" class="field-message-alert invisible absolute"></small>
            </div>
         </div>
      </fieldset>
      <fieldset class="row">
         <div class="col-sm-4">
            <div class="form-group">
               <label for="imagen">Imagen</label>
               <div class="py-2">
                  <img src="{{ $certificacion->urlImagen }}" alt="" width="360" height="260">
               </div>
               <div class="d-flex align-items-end">
                  <div class="file-select">
                     <input id="imagen" name="imagen" type="file" class="input-file" lang="es" accept=".jpg,.jpeg,.png">
                  </div>
                  <div class="archivo-seleccionado px-2">
                     <span class="align-text-bottom">Ningún archivo seleccionado</span>
                  </div>
               </div>
               <small id="errorImagen" class="field-message-alert invisible"></small>
            </div>
         </div>
      </fieldset>
      <fieldset class="row">
         <div class="col-sm-4">
            <div class="form-group">
               <label for="posicion">Posición</label>
               <input type="text" id="posicion" name="posicion" value="{{ $certificacion->cer_posicion }}"
               rows="6" class="form-control solo-numeros" id="posicion" tabindex="3"
               data-maximo-caracteres="3"></input>
               <small id="errorPosicion" class="field-message-alert invisible"></small>
            </div>
            <div class="form-group">
               <label for="estado">Estado</label>
               <select id="estado" name="estado" class="form-control" style="width: 100%" tabindex="6">
                  <option value="1" {{ $certificacion->cer_estado == 1 ? 'selected' : '' }}>Activa</option>
                  <option value="0" {{ $certificacion->cer_estado == 0 ? 'selected' : '' }}>Inactiva</option>
               </select>
               <small id="errorEstado" class="field-message-alert invisible"></small>
            </div>
         </div>
      </fieldset>
      @include('admin.components.editar_btn')
      <input type="hidden" id="idCertificacion" name="idCertificacion" data-id-certificacion="{{ $certificacion->cer_id }}" value="{{ $certificacion->cer_id }}">
   </form>
@endsection

@push('scripts')
   <script src="{{ asset('public/js/admin/sistema/certificaciones/form_modificar.js') }}"></script>
@endpush
