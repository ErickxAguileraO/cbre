@extends('layout.admin')

@section('title', 'Funcionarios')

@push('stylesheets')

@endpush

@section('content')
    <h1>Crear funcionario</h1>
    <form action="" id="formFuncionario" name="formFuncionario" class="formulario">
       @csrf
        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                <label for="nombre">Nombre</label>
                <input id="nombre" name="nombre" value="" class="form-control solo-letras" type="text" tabindex="1" data-maximo-caracteres="50"/>
                <small id="errorNombre" class="field-message-alert invisible absolute"></small>
                </div>
            </div>
        </fieldset>

        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                <label for="apellidos">Apellidos</label>
                <input id="apellidos" name="apellidos" value="" class="form-control solo-letras" type="text" tabindex="2" data-maximo-caracteres="50"/>
                <small id="errorApellidos" class="field-message-alert invisible absolute"></small>
                </div>
            </div>
        </fieldset>

        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input id="telefono" name="telefono" value="" class="form-control solo-numeros" type="text" tabindex="3" data-maximo-caracteres="9"/>
                <small id="errorTelefono" class="field-message-alert invisible absolute"></small>
                </div>
            </div>
        </fieldset>

        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                <label for="email">Email</label>
                <input id="email" name="email" value="" class="form-control" type="email" tabindex="4" data-maximo-caracteres="255"/>
                <small id="errorEmail" class="field-message-alert invisible absolute"></small>
                </div>
            </div>
        </fieldset>

        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                <label for="">Foto</label>
                <div class="d-flex align-items-end">
                    <div class="file-select">
                        <input id="foto" name="foto" type="file" class="input-file" lang="es" accept=".jpg,.jpeg,.png">
                    </div>
                    <div class="archivo-seleccionado px-2">
                        <span class="align-text-bottom">Ningún archivo seleccionado</span>
                    </div>
                </div>
                <small id="errorFoto" class="field-message-alert invisible"></small>
                </div>
            </div>
        </fieldset>

        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="cargo">Cargo</label>
                    <select id="cargo" name="cargo" class="form-control" tabindex="5">
                        <option value="">Selecciona...</option>
                        <option value="Jefe de operaciones">Jefe de operaciones</option>
                        <option value="Asistente de operaciones">Asistente de operaciones</option>
                    </select>
                    <small id="errorCargo" class="field-message-alert invisible"></small>
                </div>
            </div>
        </fieldset>

        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="edificio">Edificio</label>
                    <select id="edificio" name="edificio" class="form-control busqueda-select2" tabindex="6">
                        <option value="">Selecciona...</option>

                        @foreach ($edificios as $edificio)
                        <option value="{{ $edificio->edi_id }}">{{ $edificio->edi_nombre }}</option>
                        @endforeach

                    </select>
                    <small id="errorEdificio" class="field-message-alert invisible"></small>
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
<script src="{{ asset('public/js/admin/sistema/funcionarios/form_agregar.js') }}"></script>
@endpush
