@extends('layout.admin')
@section('title', 'Quienes somos')

@section('content')

    <h1>Editar quiénes somos</h1>

    <form action="#" method="POST" id="form-quienes_somos" class="formulario">
        @csrf
        <input type="hidden" id="qus_id" value="{{ $quienes_somos->qus_id }}">
        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="titulo">Titulo</label>
                    <input id="titulo" name="titulo" value="{{ $quienes_somos->qus_titulo }}" class="form-control" data-maximo-caracteres="50"
                        type="text" tabindex="1" />
                        <small id="titulo_error" class="field-message-alert absolute"></small>
                </div>
            </div>
        </fieldset>
        <fieldset class="row">
            <div class="col-sm-8">
                <div class="form-group">
                    <label for="texto">Texto</label>
                    <textarea name="texto" id="texto" class="form-control texto text-tarea-seccion ckeditor-input" rows="5" data-maximo-caracteres="2000">{{ $quienes_somos->qus_texto }}</textarea>
                    <small id="texto_error" class="field-message-alert absolute"></small>
                </div>
            </div>
        </fieldset>
        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="imagen">Imagen</label>
                    <div class="py-2">
                        <img id="quienes-somos-img" src="{{$quienes_somos->url_imagen}}" width="360" alt="">
                    </div>
                    <div class="d-flex align-items-end">
                        <div class="file-select">
                            <input type="file" class="input-file imagen-input" id="imagen" name="imagen"
                            lang="es" accept=".jpg,.jpeg,.png,.svg">
                        </div>
                        <div class="archivo-seleccionado px-2">
                           <span class="align-text-bottom">Ningún archivo seleccionado</span>
                        </div>
                     </div>
                     <small id="imagen_error" class="field-message-alert absolute"></small>
                </div>
            </div>
        </fieldset>
        @include('components.editar_btn')
    </form>
@endsection

@push('scripts')
    <script src="{{ asset('public\js\admin\sistema\quienes_somos\form_modificar.js') }}"></script>
@endpush
