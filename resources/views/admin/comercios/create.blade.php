@extends('layout.admin')

@section('title', 'Comercios')

@section('content')
   <h1>Crear local comercial</h1>
   <form action="" id="formComercio" name="formComercio" class="formulario">
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
               <label for="nombre">Descripción</label>
               <div class="">
                    <div>
                        <textarea name="descripcionTextarea" id="descripcionTextarea"
                            class="form-control texto text-tarea-seccion ckeditor" rows="5" tabindex="2">
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
                <label for="edificio">Edificio</label>
                <select id="edificio" name="edificio" class="form-control">
                    <option value="">Selecciona...</option>

                    @foreach ($edificios as $edificio)
                        <option value="{{ $edificio->edi_id }}" >{{ $edificio->edi_nombre }}</option>
                    @endforeach

               </select>
               <small id="errorEdificio" class="field-message-alert invisible"></small>
            </div>
         </div>
      </fieldset>
      @include('admin.components.guardar_btn')
   </form>
@endsection

@push('scripts')
   <script src="{{ asset('public/js/admin/sistema/comercios/form_agregar.js') }}"></script>
@endpush
