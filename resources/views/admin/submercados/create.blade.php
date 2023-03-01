@extends('layout.admin')
@section('title', 'Submercados')

@section('content')

    <h1>Crear Submercado</h1>

    <form action="#" method="POST" id="form-submercados" class="formulario">
        @csrf
        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input id="nombre" name="nombre" value="{{ old('nombre') }}" class="form-control" type="text" data-maximo-caracteres="50"
                        tabindex="1" />
                        <small id="nombre_error" class="field-message-alert absolute"></small>
                </div>
            </div>
        </fieldset>
        <fieldset class="row mb-5">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="region">Región</label>
                    <select name="region" id="region">
                    </select>
                    <small id="region_error" class="field-message-alert absolute"></small>
                </div>
                <div class="form-group">
                    <label for="comuna">Comuna</label>
                    <select name="comuna" id="comuna">
                    </select>
                    <small id="comuna_error" class="field-message-alert absolute"></small>
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
            <div class="col-sm-4">
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
    <script src="{{ asset('public\js\admin\sistema\submercados\form_agregar.js') }}"></script>
@endpush
