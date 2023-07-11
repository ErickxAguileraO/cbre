@extends('layout.admin')
@section('title', 'Crear formulario')
@section('content')
@push('stylesheets')
<link rel="stylesheet" href="{{ asset('/public/css/componentes/tab/tab.css') }}">
<link rel="stylesheet" href="{{ asset('/public/css/componentes/modal/modal.css') }}">

<style>
    body {
        background: #F2F2F2;
    }

    main[role=main] {
        background: #F2F2F2;
    }

    .form-group {
        margin: 0px;
    }
</style>

@endpush
<div id="" class="formulario nuevo-formulario">

    <div class="grid-header-2">
        <h1 class="col-xl">{{$formulario->form_nombre}}</h1>
        <div class="row datos-formulario">
            <a href="{{ route('formulario-area-tecnica.edit', $formulario->form_id) }}" class="estado-formulario">Salir del modo previsualizar</a>
        </div>
    </div>


    <div class="contenedor-form-preguntas">
        <div class="div-formulario-n">
            <p>{{$formulario->form_descripcion}}</p>
        </div>

    @foreach ($formulario->preguntas as $index => $pregunta)
        @if ($pregunta->tipoPregunta->tipp_id == 1)

        <div class="div-formulario-n">
            <h3 class="bottom-30">1. {{$pregunta->pre_pregunta}}</h3>
            @foreach ($pregunta->opciones as $index => $opcion)
            <div class="row align-center preguntas-preview">
                <input disabled type="radio">
                <p>{{$opcion->opc_opcion}}</p>
            </div>
            @endforeach
            @if ($pregunta->pre_obligatorio == 1)
                <div class="linea-separadora"></div>
                <p>Obligatoria</p>
            @endif
        </div>

        @elseif ($pregunta->tipoPregunta->tipp_id == 2)

        <div class="div-formulario-n">
            <h3 class="bottom-30">2. {{$pregunta->pre_pregunta}}</h3>
            @foreach ($pregunta->opciones as $index => $opcion)
            <div class="row align-center preguntas-preview">
                <input disabled type="checkbox">
                <p>{{$opcion->opc_opcion}}</p>
            </div>
            @endforeach
            @if ($pregunta->pre_obligatorio == 1)
                <div class="linea-separadora"></div>
                <p>Obligatoria</p>
            @endif
        </div>

        @elseif ($pregunta->tipoPregunta->tipp_id == 3)

        <div class="div-formulario-n">
            <h3 class="bottom-30">3. {{$pregunta->pre_pregunta}}</h3>
            <div class="form-group">
                <textarea name="" id="" class="form-control" cols="30" rows="10" disabled></textarea>
            </div>
            @if ($pregunta->pre_obligatorio == 1)
                <div class="linea-separadora"></div>
                <p>Obligatoria</p>
            @endif
        </div>

        @elseif ($pregunta->tipoPregunta->tipp_id == 4)

                    <div class="div-formulario-n">
                        <fieldset class="row row-responsive">
                            <div class="col-xl">
                                <div class="form-group">
                                    <h3 class="bottom-30">4. {{$pregunta->pre_pregunta}}</h3>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="row row-responsive">

                            <div class="col-sm-4 row-column-global sin-margen">
                                <label for="">Mes de evaluación</label>
                                <div class="form-group">
                                    <select id="" name="" class="form-control" tabindex="4"
                                        style="width:100%;" disabled>
                                        <option value="1">Seleccione</option>
                                    </select>
                                    <small id="" class="field-message-alert absolute"></small>
                                </div>
                            </div>

                            <div class="col-sm-4 row-column-global sin-margen">
                                <label for="">Año</label>
                                <div class="form-group">
                                    <select id="" name="" class="form-control" tabindex="4"
                                        style="width:100%;" disabled>
                                        <option value="1">Seleccione</option>
                                    </select>
                                    <small id="" class="field-message-alert absolute"></small>
                                </div>
                            </div>
                        </fieldset>

                        <h3 class="margin-20">Reporte de accidentabildiad CBRE</h3>

                        <fieldset class="row-global row-responsive">
                            <label class="width-250" for="">Dotación</label>
                            <div class="form-group">
                                <input id="" name="" class="form-control" type="text" tabindex="1"
                                    placeholder="" disabled>
                            </div>
                        </fieldset>

                        <fieldset class="row-global row-responsive">
                            <label class="width-250" for="">Reporte de accidentabildiad</label>
                            <div>
                                <input class="form-control input-file-nuevo" id="" name=""type="file"
                                    tabindex="1" disabled>
                            </div>
                        </fieldset>

                        <div class="linea-separadora"></div>
                        <h3 class="margin-20">Reporte de accidentabildiad Sub contratos</h3>
                        <fieldset class="row-global row-responsive">
                            <label class="width-250" for="">Dotación sub contratos</label>
                            <div class="form-group">
                                <input id="" name="" class="form-control" type="text" tabindex="1"
                                    placeholder="" disabled>
                            </div>
                        </fieldset>

                        <fieldset class="row-global row-responsive">
                            <label class="width-250" for="">¿Cuántos de estos son nuevos?</label>
                            <div class="form-group">
                                <input id="" name="" class="form-control" type="text" tabindex="1"
                                    placeholder="" disabled>
                            </div>
                        </fieldset>

                        <fieldset class="row-global row-responsive">
                            <label class="width-250" for="">¿Todos tienen documentación de sub contratación al
                                día?</label>
                            <div class="form-group row-global">
                                <div class="row-global align-center">
                                    <input type="radio" name="" id="" disabled>
                                    <p>Si</p>
                                </div>
                                <div class="row-global align-center">
                                    <input type="radio" name="" id="" disabled>
                                    <p>No</p>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="row-global row-responsive">
                            <label class="width-250" for="">Subir documentación</label>
                            <div>
                                <input class="form-control input-file-nuevo" id="" name=""type="file"
                                    tabindex="1" disabled>
                                <p style="margin-top: 10px !important;">Subir todos los documentos comprimidos en un solo
                                    archivo</p>
                            </div>
                        </fieldset>
                        @if ($pregunta->pre_obligatorio == 1)
                            <div class="linea-separadora"></div>
                            <p>Obligatoria</p>
                        @endif
                    </div>

        @endif
    @endforeach

    </div>

</div>
@endsection

@push('scripts')
<script src="{{ asset('public\js\admin\sistema\caracteristicas\form_agregar.js') }}"></script>
<script src="{{ asset('/public/css/componentes/tab/tab.js') }}"></script>
<script src="{{ asset('/public/css/componentes/modal/modal.js') }}"></script>
<script src="{{ asset('/public/js/script.js') }}"></script>

@endpush
