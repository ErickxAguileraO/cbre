@extends('layout.admin')
@section('title', 'Administradores')

@section('content')

    <h1>Editar Administrador</h1>

    <form action="#" method="POST" id="form-administrador" class="formulario">
        @csrf
        <input type="hidden" id="adm_id" value="{{ $administrador->adm_id }}">
        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input id="nombre" name="nombre" value="{{ $administrador->adm_nombre }}" class="form-control solo-letras" data-maximo-caracteres="50" type="text"
                        tabindex="1" />
                    <small id="nombre_error" class="field-message-alert absolute"></small>
                </div>
                <div class="form-group">
                    <label for="apellido">Apellido</label>
                    <input name="apellido" type="text" value="{{ $administrador->adm_apellido }}" class="form-control solo-letras" data-maximo-caracteres="50" id="apellido"
                        tabindex="3" />
                        <small id="apellido_error" class="field-message-alert absolute"></small>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input name="email" type="text" value="{{ $administrador->userTrashed->email }}" class="form-control" id="email"
                        tabindex="3" />
                        <small id="email_error" class="field-message-alert absolute"></small>
                </div>
            </div>
        </fieldset>
        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <select id="estado" name="estado" class="form-control" tabindex="4" style="width:100%;">
                        <option value="1" {{ old('estado', $administrador->deleted_at) == null ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ old('estado', $administrador->deleted_at) != null ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    <small id="estado_error" class="field-message-alert absolute"></small>
                </div>
            </div>
        </fieldset>
        @include('admin.components.editar_btn')
    </form>
@endsection

@push('scripts')
    <script src="{{ asset('public\js\admin\sistema\administradores\form_modificar.js') }}"></script>
@endpush
