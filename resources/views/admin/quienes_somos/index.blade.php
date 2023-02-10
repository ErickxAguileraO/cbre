@extends('layout.admin')
@section('title', 'Quienes Somos')

@section('content')

    <h1>Editar Quienes Somos</h1>

    <form action="#" method="POST" id="form-quienes_somos" class="formulario">
        @csrf
        <input type="hidden" id="qus_id" value="{{ $quienes_somos->qus_id }}">
        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="titulo">Titulo</label>
                    <input id="titulo" name="titulo" value="{{ $quienes_somos->qus_titulo }}" class="form-control"
                        type="text" tabindex="1" />
                    <p class="text-danger" id="titulo_error"></p>
                </div>
            </div>
        </fieldset>
        <fieldset class="row">
            <div class="col-sm-8">
                <div class="form-group">
                    <label for="texto">Texto</label>
                    <textarea name="texto" id="texto" class="form-control texto text-tarea-seccion ckeditor-input" rows="5">{{ $quienes_somos->qus_texto }}</textarea>
                    <p class="text-danger" id="texto_error"></p>
                </div>
            </div>
        </fieldset>
        <fieldset class="row my-3">
            <div class="col-sm-4">
                <div class="custom-file">
                    <input type="file" class="custom-file-input imagen-input" id="imagen" name="imagen"
                        lang="es" accept=".jpg,.jpeg,.png,.svg">
                    <label class="custom-file-label" for="imagen-input">Seleccionar Archivo</label>
                    <p class="text-danger" id="imagen_error"></p>
                </div>
            </div>
        </fieldset>
        <fieldset class="row mt-5">
            <div class="col-sm-8">
                <div class="form-group">
                    <button id="editar" type="submit" class="btn btn-primary btn-lg" value="Editar"
                        class="btn btn-primary btn-lg" type="button">
                        <div id="default" class="d-block">
                            <span class="mr-2">Editar</span>
                        </div>
                        <div id="loading" class="d-none">
                            <span class="mr-2">Editando</span>
                            <span class="spinner-border spinner-border-md" role="status" aria-hidden="true"></span>
                        </div>
                    </button>
                </div>
            </div>
        </fieldset>
    </form>
@endsection

@push('scripts')
    <script src="{{ asset('public/js/admin/jquery/ckeditor-standard/ckeditor.js') }}"></script>
    <script src="{{ asset('public\js\admin\quienes_somos\quienes_somos.js') }}"></script>
@endpush
