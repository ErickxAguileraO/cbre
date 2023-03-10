@extends('layout.admin')

@section('title', 'Certificaciones')

@section('content')
   <h1>Crear certificación</h1>
   <form action="" id="formCertificacion" name="formCertificacion" class="formulario">
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
         <div class="col-sm-4">
            <div class="form-group">
               <label for="imagen">Imagen</label>
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
               <input type="text" id="posicion" name="posicion" rows="6" class="form-control solo-numeros" id="posicion" tabindex="3"
               data-maximo-caracteres="3"></input>
               <small id="errorPosicion" class="field-message-alert invisible"></small>
            </div>
            <div class="form-group">
               <label for="estado">Estado</label>
               <select id="estado" name="estado" class="form-control" style="width: 100%" tabindex="6">
                  <option value="1" >Activa</option>
                  <option value="0">Inactiva</option>
               </select>
               <small id="errorEstado" class="field-message-alert invisible"></small>
            </div>
         </div>
      </fieldset>
      <fieldset class="row mt-5">
        <div class="col-sm-8">
            <div class="form-group">
                <button id="guardar" type="submit" class="btn btn-success btn-lg" value="Guardar"
                    class="btn btn-success btn-lg" type="button">
                    <div id="default" class="d-block">
                        <span class="">Guardar</span>
                    </div>
                    <div id="loading" class="d-none">
                        <span class="mr-2">Guardando</span>
                        <span class="spinner-border spinner-border-md" role="status" aria-hidden="true"></span>
                    </div>
                </button>

            </div>
        </div>
    </fieldset>
   </form>
@endsection

@push('scripts')
   <script src="{{ asset('public/js/admin/sistema/certificaciones/form_agregar.js') }}"></script>
@endpush
