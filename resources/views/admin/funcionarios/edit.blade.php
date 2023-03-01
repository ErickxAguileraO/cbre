@extends('layout.admin')

@section('title', 'Funcionarios')

@push('stylesheets')
   
@endpush

@section('content')
    <h1>Modificar funcionario</h1>
    <form action="" id="formFuncionario" name="formFuncionario" class="formulario">
       @csrf
       @method('PUT')
        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                <label for="nombre">Nombre</label>
                <input id="nombre" name="nombre" value="{{ $funcionario->fun_nombre }}" class="form-control solo-letras" type="text" tabindex="1" data-maximo-caracteres="50"/>
                <small id="errorNombre" class="field-message-alert invisible absolute"></small>
                </div>
            </div>
        </fieldset>

        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                <label for="apellidos">Apellidos</label>
                <input id="apellidos" name="apellidos" value="{{ $funcionario->fun_apellido }}" class="form-control solo-letras" type="text" tabindex="2" data-maximo-caracteres="50"/>
                <small id="errorApellidos" class="field-message-alert invisible absolute"></small>
                </div>
            </div>
        </fieldset>

        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input id="telefono" name="telefono" value="{{ $funcionario->fun_telefono }}" class="form-control solo-numeros" type="text" tabindex="3" data-maximo-caracteres="9"/>
                <small id="errorTelefono" class="field-message-alert invisible absolute"></small>
                </div>
            </div>
        </fieldset>

        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                <label for="email">Email</label>
                <input id="email" name="email" value="{{ $funcionario->user->email }}" class="form-control" type="email" tabindex="4" data-maximo-caracteres="255"/>
                <small id="errorEmail" class="field-message-alert invisible absolute"></small>
                </div>
            </div>
        </fieldset>

        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                <label for="">Foto</label>
                <div class="py-2">
                  <img src="{{ $funcionario->urlImagen }}" alt="" width="360" height="260">
               </div>
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
                        <option value="Jefe de operaciones" {{ $funcionario->fun_cargo == 'Jefe de operaciones' ? 'selected' : '' }}>Jefe de operaciones</option>
                        <option value="Asistente de operaciones"{{ $funcionario->fun_cargo == 'Asistente de operaciones' ? 'selected' : '' }}>Asistente de operaciones</option>
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
                        <option value="{{ $edificio->edi_id }}"
                        {{ $funcionario->fun_edificio_id == $edificio->edi_id ? 'selected' : '' }}
                        >
                        {{ $edificio->edi_nombre }}</option>
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
                <input id="guardarButton" type="submit" class="btn boton-submit-formulario btn-lg" value="Guardar" />
            </div>
        </div>
        </fieldset>
        <input type="hidden" id="idFuncionario" name="idFuncionario" data-id-funcionario="{{ $funcionario->fun_id }}" value="{{ $funcionario->fun_id }}">
    </form>
@endsection

@push('scripts')
<script src="{{ asset('public/js/admin/sistema/funcionarios/form_modificar.js') }}"></script>
@endpush
