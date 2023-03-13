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
        @include('admin.components.guardar_btn')
    </form>
@endsection

@push('scripts')
    <script src="{{ asset('public\js\admin\sistema\submercados\form_agregar.js') }}"></script>
@endpush
