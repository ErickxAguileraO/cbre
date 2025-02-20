@extends('layout.admin')

@section('title', 'Locales comerciales')

@section('content')
   <h1>Modificar local</h1>
   <form action="" id="formComercio" name="formComercio" class="formulario">
   @csrf
   @method('PUT')
      <fieldset class="row">
         <div class="col-sm-4">
            <div class="form-group">
               <label for="nombre">Nombre</label>
               <input id="nombre" name="nombre" value="{{ $comercio->loc_nombre }}" class="form-control" type="text" tabindex="1" data-maximo-caracteres="255"/>
               <small id="errorNombre" class="field-message-alert invisible absolute"></small>
            </div>
         </div>
      </fieldset>
      <fieldset class="row">
         <div class="col-sm-4">
            <div class="form-group">
               <label for="descripcion">Descripción</label>
               <div class="">
                    <div>
                        <textarea name="descripcionTextarea" id="descripcionTextarea" class="form-control texto text-tarea-seccion ckeditor" rows="5" tabindex="2">{{ $comercio->loc_descripcion }}</textarea>
                    </div>
                </div>
               <small id="errorDescripcion" class="field-message-alert invisible absolute"></small>
            </div>
         </div>
      </fieldset>
      <fieldset class="row">
         <div class="col-sm-4">
            <div class="form-group">
               <label for="">Imagen</label>
               <div class="py-2">
                  <img src="{{ $comercio->urlImagen }}" alt="" width="360" height="260">
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
                <label for="edificio">Edificio</label>
                <select id="edificio" name="edificio" class="form-control busqueda-select2">
                    <option value="">Sin edificio</option>

                    @foreach ($edificios as $edificio)
                        <option value="{{ $edificio->edi_id }}"

                        {{  $edificio->edi_id == $comercio->edificio->edi_id ? 'selected' : '' }}
                        >
                           {{ $edificio->edi_nombre }}
                        </option>
                    @endforeach

               </select>
               <small id="errorEdificio" class="field-message-alert invisible"></small>
            </div>
         </div>
      </fieldset>
      @include('components.editar_btn')
      <input type="hidden" id="idComercio" name="idComercio" data-id-comercio="{{ $comercio->loc_id }}" value="{{ $comercio->loc_id }}">
   </form>
@endsection

@push('scripts')
   <script src="{{ asset('public/js/admin/sistema/comercios/form_modificar.js') }}"></script>
@endpush
