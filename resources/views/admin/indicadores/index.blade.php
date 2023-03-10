@extends('layout.admin')
@section('title', 'Indicadores')

@section('content')

    <h1>Editar indicadores</h1>

    <form action="#" method="POST" id="form-indicadores" class="formulario">
        @csrf
        <input type="hidden" id="ind_id" value="{{ $indicadores->ind_id }}">
        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="edificios_administrados">Edificios administrados</label>
                    <input id="edificios_administrados" name="edificios_administrados" value="{{ $indicadores->ind_administrados }}" class="form-control solo-numeros" data-maximo-caracteres="9"
                        type="text" tabindex="1" />
                        <small id="edificios_administrados_error" class="field-message-alert absolute"></small>
                </div>
            </div>
        </fieldset>
        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="confia_en_nosotros">Clientes confian en nosotros</label>
                    <input id="confia_en_nosotros" name="confia_en_nosotros" value="{{ $indicadores->ind_confia_en_nosotros }}" class="form-control solo-numeros" data-maximo-caracteres="9"
                        type="text" tabindex="1" />
                        <small id="confia_en_nosotros_error" class="field-message-alert absolute"></small>
                </div>
            </div>
        </fieldset>
        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="en_todo_chile">Oficinas en todo Chile</label>
                    <input id="en_todo_chile" name="en_todo_chile" value="{{ $indicadores->ind_en_todo_chile }}" class="form-control solo-numeros" data-maximo-caracteres="9"
                        type="text" tabindex="1" />
                        <small id="en_todo_chile_error" class="field-message-alert absolute"></small>
                </div>
            </div>
        </fieldset>
        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="en_todo_chile2">Metros cuadrados administrados</label>
                    <input id="en_todo_chile2" name="en_todo_chile2" value="{{ $indicadores->ind_en_todo_chile2 }}" class="form-control solo-numeros" data-maximo-caracteres="9"
                        type="text" tabindex="1" />
                        <small id="en_todo_chile2_error" class="field-message-alert absolute"></small>
                </div>
            </div>
        </fieldset>
        <fieldset class="row mt-5">
            <div class="col-sm-4">
                <div class="form-group">
                    <button id="editar" type="submit" class="btn btn-success btn-lg" value="Editar"
                        class="btn btn-success btn-lg" type="button">
                        <div id="default" class="d-block">
                            <span class="">Editar</span>
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
    <script src="{{ asset('public\js\admin\sistema\indicadores\form_modificar.js') }}"></script>
@endpush

