@extends('layout.admin')
@section('title', 'Caracteristicas')

@section('content')

    <h1>Crear Característica</h1>

    <form action="#" method="POST" id="form-caracteristica" class="formulario">
        @csrf
        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input id="nombre" name="nombre" value="{{ old('nombre') }}" class="form-control" type="text"
                        tabindex="1" />
                        <p class="text-danger" id="nombre_error"></p>
                </div>
                <div class="form-group">
                    <label for="video">Video</label>
                    <input name="video" type="text" value="{{ old('video') }}" class="form-control" id="video"
                        tabindex="3" />
                        <p class="text-danger" id="video_error"></p>
                </div>
            </div>
        </fieldset>
        <fieldset class="row">
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="posicion">Posición</label>
                    <input name="posicion" type="number" value="{{ old('posicion') }}" class="form-control" id="posicion"
                        tabindex="2" />
                        <p class="text-danger" id="posicion_error"></p>
                </div>
            </div>
        </fieldset>
        <fieldset class="row">
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <select id="estado" name="estado" class="form-control" tabindex="4" style="width:100%;">
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                    <p class="text-danger" id="estado_error"></p>
                </div>
            </div>
        </fieldset>
        <fieldset class="row my-3">
            <div class="col-sm-4">
                <label for="imagen">Imagen</label>
                <div class="d-flex align-items-end">
                    <div class="file-select">
                        <input type="file" class="input-file imagen-input" id="imagen" name="imagen"
                        lang="es" accept=".jpg,.jpeg,.png,.svg">
                    </div>
                    <div class="archivo-seleccionado px-2">
                       <span class="align-text-bottom">Ningún archivo seleccionado</span>
                    </div>
                 </div>
                 <p class="text-danger" id="imagen_error"></p>
            </div>
        </fieldset>
        <fieldset class="row mt-5">
            <div class="col-sm-8">
                <div class="form-group">
                        <button id="guardar" type="submit" class="btn btn-success btn-lg" value="Guardar"
                            class="btn btn-success btn-lg" type="button">
                            <div id="default" class="d-block">
                                <span class="mr-2">Guardar</span>
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
    <script src="{{ asset('public\js\admin\sistema\caracteristicas\create.js') }}"></script>
@endpush
