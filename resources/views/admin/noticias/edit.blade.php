@extends('layout.admin')

@section('title', 'Noticias')

@section('content')
   <h1>Modificar noticia</h1>
   <form action="" id="formNoticia" name="formNoticia" class="formulario">
   @csrf
   @method('PUT')
      <fieldset class="row">
         <div class="col-sm-4">
            <div class="form-group">
               <label for="nombre">Título</label>
               <input id="titulo" name="titulo" value="{{ $noticia->not_titulo }}" class="form-control" type="text" tabindex="1" data-maximo-caracteres="255"/>
               <small id="errorTitulo" class="field-message-alert invisible absolute"></small>
            </div>
         </div>
      </fieldset>
      <fieldset class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label for="titulo">Fecha publicación</label>
                <input type="datetime-local" class="form-control" min="{{ Carbon\Carbon::now('America/Santiago')->toDateString() }}" id="fecha"
                    name="fecha" placeholder="DD/MM/AAAA" value="{{ date('Y-m-d\TH:i:s', strtotime($noticia->not_fecha)) }}">
                <small id="errorFecha" class="field-message-alert invisible absolute"></small>
            </div>
        </div>
     </fieldset>
      <fieldset class="row">
         <div class="col-sm-8">
            <div class="form-group">
               <label for="nombre">Cuerpo</label>
               <div class="">
                    <div>
                        <textarea name="cuerpoTextarea" id="cuerpoTextarea"
                            class="form-control texto text-tarea-seccion ckeditor" rows="5" tabindex="2">
                            {{ $noticia->not_texto }}
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
               <label for="">Imagen</label>
               <div class="py-2">
                  <img src="{{ $noticia->urlImagen }}" alt="" width="360" height="260">
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
      <fieldset class="row mb-5">
        <div class="col-sm-4">
            <div class="form-check">
                <input type="checkbox" name="destacada" id="destacada" class="form-check-input" value="" {{ $noticia->not_destacada == 1 ? 'checked' : '' }}>
                <span class="ml-2">Noticia destacada</span>
            </div>
        </div>B
    </fieldset>

      <fieldset class="row">
         <div class="col-sm-4">
            <div class="form-group">
                <label for="edificio">Edificio</label>
                <select id="edificio" name="edificio" class="form-control">
                    <option value="">Sin edificio</option>

                    @foreach ($edificios as $edificio)
                        <option value="{{ $edificio->edi_id }}"

                        {{ isset($noticia->edificio) && ($edificio->edi_id == $noticia->edificio->edi_id) ? 'selected' : '' }}
                        >
                           {{ $edificio->edi_nombre }}
                        </option>
                    @endforeach

               </select>
               <small id="errorEdificio" class="field-message-alert invisible"></small>
            </div>
         </div>
      </fieldset>
      <br>
      <br>
      <fieldset class="row">
         <div class="col-sm-4">
            <div class="form-group">
               <input id="guardarButton" type="submit" class="btn btn-success btn-lg" value="Guardar" />
            </div>
         </div>
      </fieldset>
      <input type="hidden" id="idNoticia" name="idNoticia" data-id-noticia="{{ $noticia->not_id }}" value="{{ $noticia->not_id }}">
   </form>
@endsection

@push('scripts')
   <script src="{{ asset('public/js/admin/sistema/noticias/form_modificar.js') }}"></script>
@endpush
