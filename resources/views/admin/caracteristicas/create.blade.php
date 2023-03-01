@extends('layout.admin')
@section('title', 'Caracteristicas')

@section('content')

    <h1>Crear característica</h1>

    <form action="#" method="POST" id="form-caracteristica" class="formulario">
        @csrf
        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input id="nombre" name="nombre" value="{{ old('nombre') }}" class="form-control" data-maximo-caracteres="50" type="text"
                        tabindex="1" />
                        <small id="nombre_error" class="field-message-alert absolute"></small>
                </div>
            </div>
        </fieldset>
        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
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
                     <small id="imagen_error" class="field-message-alert absolute"></small>
                </div>
            </div>
        </fieldset>
        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="posicion">Posición</label>
                    <input name="posicion" type="text" value="{{ old('posicion') }}" class="form-control solo-numeros" data-maximo-caracteres="3" id="posicion"
                        tabindex="2" />
                        <small id="posicion_error" class="field-message-alert absolute"></small>
                </div>
            </div>
        </fieldset>
        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <select id="estado" name="estado" class="form-control" tabindex="4" style="width:100%;">
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                    <small id="estado_error" class="field-message-alert absolute"></small>
                </div>
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
    <script src="{{ asset('public\js\admin\sistema\caracteristicas\form_agregar.js') }}"></script>
@endpush
