@extends('layout.admin')
@section('title', 'Datos Generales')

@section('content')

    <h1>Editar Datos Generales</h1>

    <form action="#" method="POST" id="form-datos-generales" class="formulario">
        @csrf
        <input type="hidden" id="dag_id" value="{{ $datos_generales->dag_id }}">
        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="direccion">Dirección</label>
                    <input id="direccion" name="direccion" value="{{ $datos_generales->dag_direccion }}" class="form-control"
                        type="text" tabindex="1" />
                    <p class="field-message-alert" id="direccion_error"></p>
                </div>
            </div>
        </fieldset>
        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="region">Región</label>
                    <select name="region" id="region">
                    </select>
                    <p class="field-message-alert" id="region_error"></p>
                </div>
                <div class="form-group">
                    <label for="comuna">Comuna</label>
                    <select name="comuna" id="comuna">
                    </select>
                    <p class="text-danger" id="comuna_error"></p>
                </div>
            </div>
        </fieldset>
        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="telefono_uno">Teléfono</label>
                    <input id="telefono_uno" name="telefono_uno" value="{{ $datos_generales->dag_telefono_uno }}" class="form-control"
                        type="text" tabindex="1" />
                    <p class="field-message-alert" id="telefono_uno_error"></p>
                </div>
            </div>
        </fieldset>
        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="telefono_dos">Teléfono 2</label>
                    <input id="telefono_dos" name="telefono_dos" value="{{ $datos_generales->dag_telefono_dos }}" class="form-control"
                        type="text" tabindex="1" />
                    <p class="field-message-alert" id="telefono_dos_error"></p>
                </div>
            </div>
        </fieldset>
        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="email">Email Encargado</label>
                    <input id="email" name="email" value="{{ $datos_generales->dag_email_encargado }}" class="form-control"
                        type="text" tabindex="1" />
                    <p class="field-message-alert" id="email_error"></p>
                </div>
            </div>
        </fieldset>
        <div class="row mb-4">
            <div class="col-sm-4">
                <hr>
            </div>
        </div>
        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="facebook">Facebook</label>
                    <input id="facebook" name="facebook" value="{{ $datos_generales->dag_facebook }}" class="form-control"
                        type="text" tabindex="1" />
                    <p class="field-message-alert" id="facebook_error"></p>
                </div>
            </div>
        </fieldset>
        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="linkedin">Linkedin</label>
                    <input id="linkedin" name="linkedin" value="{{ $datos_generales->dag_linkedin }}" class="form-control"
                        type="text" tabindex="1" />
                    <p class="field-message-alert" id="linkedin_error"></p>
                </div>
            </div>
        </fieldset>
        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="instagram">Instagram</label>
                    <input id="instagram" name="instagram" value="{{ $datos_generales->dag_instagram }}" class="form-control"
                        type="text" tabindex="1" />
                    <p class="field-message-alert" id="instagram_error"></p>
                </div>
            </div>
        </fieldset>
        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="twitter">Twitter</label>
                    <input id="twitter" name="twitter" value="{{ $datos_generales->dag_twitter }}" class="form-control"
                        type="text" tabindex="1" />
                    <p class="field-message-alert" id="twitter_error"></p>
                </div>
            </div>
        </fieldset>
        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="youtube">Youtube</label>
                    <input id="youtube" name="youtube" value="{{ $datos_generales->dag_youtube }}" class="form-control"
                        type="text" tabindex="1" />
                    <p class="field-message-alert" id="youtube_error"></p>
                </div>
            </div>
        </fieldset>
        <fieldset class="row mt-5">
            <div class="col-sm-4">
                <div class="form-group">
                    <button id="editar" type="submit" class="btn btn-success btn-lg" value="Editar"
                        class="btn btn-success btn-lg" type="button">
                        <div id="default" class="d-block">
                            <span class="mr-2">Editar</span>
                        </div>
                        <div id="loading" class="d-none">
                            <span class="mr-2">Editando</span>
                            <span class="spinner-border spinner-border-md" role="status" aria-hidden="true"></span>
                        </div>
                    </button>
                </div>
            </div>
        </fieldset>
    </form>
@endsection

@push('scripts')
    <script src="{{ asset('public\js\admin\sistema\datos_generales\edit.js') }}"></script>
@endpush
