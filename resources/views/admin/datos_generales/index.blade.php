@extends('layout.admin')
@section('title', 'Datos generales')

@section('content')

    <h1>Editar datos generales</h1>

    <form action="#" method="POST" id="form-datos-generales" class="formulario">
        @csrf
        <input type="hidden" id="dag_id" value="{{ $datos_generales->dag_id }}">
        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="direccion">Dirección</label>
                    <input id="direccion" name="direccion" value="{{ $datos_generales->dag_direccion }}" class="form-control" data-maximo-caracteres="100"
                        type="text" tabindex="1" />
                        <small id="direccion_error" class="field-message-alert absolute"></small>
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
                    <label for="telefono_uno">Teléfono</label>
                    <input id="telefono_uno" name="telefono_uno" value="{{ $datos_generales->dag_telefono_uno }}" class="form-control solo-numeros" data-maximo-caracteres="9"
                        type="text" tabindex="1" />
                        <small id="telefono_uno_error" class="field-message-alert absolute"></small>
                </div>
            </div>
        </fieldset>
        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="telefono_dos">Teléfono 2</label>
                    <input id="telefono_dos" name="telefono_dos" value="{{ $datos_generales->dag_telefono_dos }}" class="form-control solo-numeros" data-maximo-caracteres="9"
                        type="text" tabindex="1" />
                        <small id="telefono_dos_error" class="field-message-alert absolute"></small>
                </div>
            </div>
        </fieldset>

        <fieldset class="row">
            <div class="col-sm-4">
                <div class="hr-sect mb-5"><span class="small text-secondary">&nbsp;Información del encargado</span></div>
                <div class="form-group">
                    <label for="nombre">Nombre encargado</label>
                    <input id="nombre" name="nombre" value="{{ $datos_generales->dag_nombre_encargado }}" data-maximo-caracteres="50" class="form-control"
                        type="text" tabindex="1" />
                        <small id="nombre_error" class="field-message-alert absolute"></small>
                </div>
            </div>
        </fieldset>
        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="cargo">Cargo encargado</label>
                    <input id="cargo" name="cargo" value="{{ $datos_generales->dag_cargo_encargado }}" data-maximo-caracteres="50" class="form-control"
                        type="text" tabindex="1" />
                        <small id="cargo_error" class="field-message-alert absolute"></small>
                </div>
            </div>
        </fieldset>
        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="telefono">Teléfono encargado</label>
                    <input id="telefono" name="telefono" value="{{ $datos_generales->dag_telefono_encargado }}" data-maximo-caracteres="9" class="form-control solo-numeros"
                        type="text" tabindex="1" />
                        <small id="telefono_error" class="field-message-alert absolute"></small>
                </div>
            </div>
        </fieldset>
        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="email">Email encargado</label>
                    <input id="email" name="email" value="{{ $datos_generales->dag_email_encargado }}" class="form-control"
                        type="text" tabindex="1" />
                        <small id="email_error" class="field-message-alert absolute"></small>
                </div>
            </div>
        </fieldset>
        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="imagen">Imagen</label>
                    <div class="py-2">
                        <img id="datos-generales-img" src="{{$datos_generales->urlImagen}}" width="360" alt="">
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
                <div class="hr-sect mb-5"><span class="small text-secondary">&nbsp;Redes sociales</span></div>
                <div class="form-group">
                    <label for="facebook">Facebook</label>
                    <input id="facebook" name="facebook" value="{{ $datos_generales->dag_facebook }}" class="form-control"
                        type="text" tabindex="1" />
                        <small id="facebook_error" class="field-message-alert absolute"></small>
                </div>
            </div>
        </fieldset>
        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="linkedin">Linkedin</label>
                    <input id="linkedin" name="linkedin" value="{{ $datos_generales->dag_linkedin }}" class="form-control"
                        type="text" tabindex="1" />
                        <small id="linkedin_error" class="field-message-alert absolute"></small>
                </div>
            </div>
        </fieldset>
        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="instagram">Instagram</label>
                    <input id="instagram" name="instagram" value="{{ $datos_generales->dag_instagram }}" class="form-control"
                        type="text" tabindex="1" />
                        <small id="instagram_error" class="field-message-alert absolute"></small>
                </div>
            </div>
        </fieldset>
        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="twitter">Twitter</label>
                    <input id="twitter" name="twitter" value="{{ $datos_generales->dag_twitter }}" class="form-control"
                        type="text" tabindex="1" />
                        <small id="twitter_error" class="field-message-alert absolute"></small>
                </div>
            </div>
        </fieldset>
        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="youtube">Youtube</label>
                    <input id="youtube" name="youtube" value="{{ $datos_generales->dag_youtube }}" class="form-control"
                        type="text" tabindex="1" />
                        <small id="youtube_error" class="field-message-alert absolute"></small>
                </div>
            </div>
        </fieldset>
        @include('components.editar_btn')
    </form>
@endsection

@push('scripts')
    <script src="{{ asset('public\js\admin\sistema\datos_generales\form_modificar.js') }}"></script>
@endpush
