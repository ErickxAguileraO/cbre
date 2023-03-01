@extends('layout.admin')

@section('title', 'Noticias')

@push('stylesheets')
   <link rel="stylesheet" type="text/css" href="{{ asset('public/js/admin/jquery/croppie/css/croppie.min.css') }}"/>
@endpush

@section('content')
   <h1>Crear noticia</h1>
   <form action="" id="formNoticia" name="formNoticia" class="formulario">
   @csrf
      <fieldset class="row">
         <div class="col-sm-4">
            <div class="form-group">
               <label for="titulo">Título</label>
               <input id="titulo" name="titulo" value="" class="form-control" type="text" tabindex="1" data-maximo-caracteres="255"/>
               <small id="errorTitulo" class="field-message-alert invisible absolute"></small>
            </div>
         </div>
      </fieldset>
      <fieldset class="row">
        <div class="col-sm-4">
           <div class="form-group">
                <label for="titulo">Fecha publicación</label>
                <input type="datetime-local" class="form-control" min="{{ \Carbon\Carbon::now('America/Santiago')->format('Y-m-d\TH:i') }}" id="fecha" name="fecha" placeholder="DD/MM/AAAA">
                <small id="errorFecha" class="field-message-alert invisible absolute"></small>
           </div>
        </div>
     </fieldset>
      <fieldset class="row">
         <div class="col-sm-8">
            <div class="form-group">
               <label for="cuerpoTextarea">Cuerpo</label>
               <div class="">
                    <div>
                        <textarea name="cuerpoTextarea" id="cuerpoTextarea"
                            class="form-control texto text-tarea-seccion ckeditor" rows="5" tabindex="2">
                        </textarea>
                    </div>
                </div>
               <small id="errorCuerpo" class="field-message-alert invisible absolute"></small>
            </div>
         </div>
      </fieldset>
      <fieldset class="row">
        <div class="col-sm-4">
           <div class="form-group">
              <div class="contenedor croppie-container">
                 <div class="imagen1"><span>Imagen (tamaño mínimo 890px X 300px)</span>
                    <div class="container-content my-5">
                          <img class="full default-image-croppie" style="cursor: pointer;" src="{{ asset('public/images/admin/sistema/resizing.png') }}" width="230" />
                          <div class="d-none my-4 croppie-image single-image" data-min-width="890" data-min-height="300"></div>
                    </div>
                    <div class="position-relative">
                       <div class="custom-file">
                          <input type="file" id="inputFileGaleria" class="custom-file-input imagen-input" lang="es" accept=".jpg,.jpeg,.png">
                          <label class="custom-file-label" for="imagen-input">Buscar un archivo</label>
                       </div>
                    </div>
                    <div class="modal-footer_imagen" style="text-align:left;margin-top: 15px;">
                       <button type="button" class="btn btn-outline-dark cancel-croppie">Cancelar</button>
                       <button type="button" class="btn btn-outline-primary add-image-croppie">Agregar</button>
                    </div>
                    <br>
                    <div class="mt-4 container-gallery">
                       <label class="mb-4">Imagen cargada</label>
                       <div class="row images-gallery"></div>
                    </div>
                 </div>
              </div>
              <small id="errorImagenesGaleria" class="field-message-alert invisible"></small>
           </div>
        </div>
     </fieldset>
      <fieldset class="row mb-5">
        <div class="col-sm-4">
            <div class="form-check">
                  <input type="checkbox" name="destacada" id="destacada" class="form-check-input" value=""> <span class="ml-2">Noticia destacada</span>
              </div>
        </div>
     </fieldset>

      @role('super-admin')
         <fieldset class="row">
            <div class="col-sm-4">
               <div class="form-group">
                  <label for="edificio">Edificio</label>
                  <select id="edificio" name="edificio" class="form-control busqueda-select2">
                     <option value="">Sin edificio</option>

                     @foreach ($edificios as $edificio)
                           <option value="{{ $edificio->edi_id }}" >{{ $edificio->edi_nombre }}</option>
                     @endforeach

                  </select>
                  <small id="errorEdificio" class="field-message-alert invisible"></small>
               </div>
            </div>
         </fieldset>
      @else
         @if ( auth()->user()->funcionario != null )
            <input type="hidden" id="edificio" name="edificio" value="{{ auth()->user()->funcionario->edificio->edi_id }}">
         @else
            <input type="hidden" id="edificio" name="edificio" value="">
         @endif
      @endrole

      <br>
      <br>
      <fieldset class="row">
         <div class="col-sm-4">
            <div class="form-group">
               <input id="guardarButton" type="submit" class="btn btn-success btn-lg" value="Guardar" />
            </div>
         </div>
      </fieldset>
   </form>
@endsection

@push('scripts')
    <script src="{{ asset('public/js/admin/jquery/croppie/js/croppie.min.js') }}"></script>
   <script src="{{ asset('public/js/admin/sistema/noticias/form_agregar.js') }}"></script>
@endpush
