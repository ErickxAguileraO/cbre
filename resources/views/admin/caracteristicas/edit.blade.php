@extends('layout.admin')
@section('title', 'Caracteristicas')

@section('content')

    <h1>Editar característica</h1>

    <form action="#" method="POST" id="form-caracteristica" class="formulario">
        @csrf
        <input type="hidden" id="car_id" value="{{ $caracteristica->car_id }}">
        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input id="nombre" name="nombre" value="{{ $caracteristica->car_nombre }}" class="form-control" data-maximo-caracteres="50"
                        type="text" tabindex="1" />
                        <small id="nombre_error" class="field-message-alert absolute"></small>
                </div>
            </div>
        </fieldset>
        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="imagen">Imagen</label>
                    <div class="py-2">
                        <img src="{{$caracteristica->url_imagen}}" style="background-color: #538184" width="360" height="260" alt="">
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
        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="posicion">Posición</label>
                    <input name="posicion" type="text" value="{{ $caracteristica->car_posicion }}" class="form-control solo-numeros" data-maximo-caracteres="3"
                        id="posicion" tabindex="2" />
                        <small id="posicion_error" class="field-message-alert absolute"></small>
                </div>
            </div>
        </fieldset>
        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <select id="estado" name="estado" class="form-control" tabindex="4" style="width:100%;">
                        <option value="1"{{ $caracteristica->car_estado == 1 ? 'selected' : '' }}>Activo</option>
                        <option value="0"{{ $caracteristica->car_estado == 0 ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    <small id="estado_error" class="field-message-alert absolute"></small>
                </div>
            </div>
        </fieldset>
        @include('components.editar_btn')
    </form>
@endsection

@push('scripts')
    <script src="{{ asset('public\js\admin\sistema\caracteristicas\form_modificar.js') }}"></script>
@endpush
