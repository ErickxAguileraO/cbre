@extends('layout.admin')

@section('title', 'Certificaciones')

@section('content')
   <h1>Crear certificación</h1>
   <form action="" method="POST" id="form-noticias" class="formulario">
   @csrf
      <fieldset class="row">
         <div class="col-sm-6">
            <div class="form-group">
               <label for="nombre">Nombre</label>
               <input id="nombre" name="nombre" value="" class="form-control" type="text" tabindex="1" />
               @error('nombre')
                  <p class="field-message-alert"> {{ $message }}</p>
               @enderror
            </div>
         </div>
      </fieldset>
      <fieldset class="row">
         <div class="col-sm-6">
            <div class="form-group">
               <label for="imagen">Imagen</label>
               <div class="d-flex align-items-end">
                  <div class="file-select">
                     <input type="file" class="input-file" lang="es" accept=".jpg,.jpeg,.png">
                  </div>
                  <div class="archivo-seleccionado px-2">
                     <span class="align-text-bottom">Ningún archivo seleccionado</span>
                  </div>
               </div>
               
               @error('imagen')
                  <p class="field-message-alert"> {{ $message }}</p>
               @enderror
            </div>
         </div>
      </fieldset>
      <fieldset class="row">
         <div class="col-sm-6">
            <div class="form-group">
               <label for="posicion">Posición</label>
               <input type="number" name="posicion" rows="6" class="form-control" id="posicion" tabindex="3"></input>
               @error('posicion')
                  <p class="field-message-alert"> {{ $message }}</p>
               @enderror
            </div>
            <div class="form-group">
               <label for="estado">Estado</label>
               <select id="estado" name="estado" class="form-control" style="width: 100%" tabindex="6">
                  <option value="1" >Activa</option>
                  <option value="0">Inactiva</option>
               </select>
               @error('estado')
                  <p class="field-message-alert"> {{ $message }}</p>
               @enderror
            </div>
         </div>
      </fieldset>
      <br>
      <br>
      <fieldset class="row">
         <div class="col-sm-6">
            <div class="form-group">
               <input id="guardar" type="submit" class="btn btn-success btn-lg" value="Guardar" />
            </div>
         </div>
      </fieldset>
   </form>
@endsection

@push('scripts')
   <script src="{{ asset('public/js/admin/sistema/certificaciones/form_agregar.js') }}"></script>
@endpush
