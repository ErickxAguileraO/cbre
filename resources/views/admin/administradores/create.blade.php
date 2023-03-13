@extends('layout.admin')
@section('title', 'Administradores')

@section('content')

    <h1>Crear Administrador</h1>

    <form action="#" method="POST" id="form-administrador" class="formulario">
        @csrf
        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input id="nombre" name="nombre" value="{{ old('nombre') }}" class="form-control solo-letras" data-maximo-caracteres="50" type="text"
                        tabindex="1" />
                    <small id="nombre_error" class="field-message-alert absolute"></small>
                </div>
                <div class="form-group">
                    <label for="apellido">Apellido</label>
                    <input name="apellido" type="text" value="{{ old('apellido') }}" class="form-control solo-letras" data-maximo-caracteres="50" id="apellido"
                        tabindex="3" />
                        <small id="apellido_error" class="field-message-alert absolute"></small>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input name="email" type="text" value="{{ old('email') }}" class="form-control" id="email"
                        tabindex="3" />
                        <small id="email_error" class="field-message-alert absolute"></small>
                </div>
{{--                 <div class="form-group">
                    <label for="password">Contraseña</label>
                    <div class="password-input-container">
                        <input name="password" type="password" value="{{ old('password') }}"
                            class="form-control password-input" id="password" tabindex="3" />
                        <i class="fas fa-eye password-toggle-icon"></i>
                    </div>
                    <small id="password_error" class="field-message-alert absolute"></small>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Repita la contraseña</label>
                    <div class="password-input-container">
                        <input name="password_confirmation" type="password" value="{{ old('password_confirmation') }}"
                            class="form-control password-input" id="password_confirmation" tabindex="3" />
                        <i class="fas fa-eye password-toggle-icon"></i>
                    </div>
                    <small id="password_confirmation_error" class="field-message-alert absolute"></small>
                </div> --}}
            </div>
        </fieldset>
        @include('components.guardar_btn')
    </form>
@endsection

@push('scripts')
    <script src="{{ asset('public\js\admin\sistema\administradores\form_agregar.js') }}"></script>
@endpush
