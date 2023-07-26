<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}

    <livewire:administracion.formulario.upload-file-modal-respuesta :formId="$formulario->form_id"/>

            @if ($formulario->form_descripcion != '')
            <div class="div-formulario-n">
                <p>{{ $formulario->form_descripcion }}</p>
            </div>
            @endif

            @foreach ($formulario->preguntas as $index => $pregunta)
                @if ($pregunta->tipoPregunta->tipp_id == 1)
                    <div class="div-formulario-n">
                        <h3 class="">{{ $pregunta->pre_pregunta }}</h3>
                        @if ($pregunta->archivosFormulario->count() > 0)
                        <div class="color-texto-cbre bottom-20 cursor-pointer small">
                            <i class="far fa-paperclip"></i>
                            <a href="{{ route('formulario-area-tecnica.archivos', [$formulario->form_id, $pregunta->pre_id]) }}" class="text-decoration-none">Información complementaria</a>
                        </div>
                        @endif
                        @foreach ($pregunta->opciones as $opcion)
                            <div class="row align-center preguntas-preview">
                                <input type="radio" name="opcion{{ $pregunta->pre_id }}"
                                    wire:click="selectOption({{ $opcion->opc_id }})" wire:loading.attr="disabled">
                                <p>{{ $opcion->opc_opcion }}</p>
                            </div>
                        @endforeach
                        <div class="opciones-pregunta grid-header-2">
                            <div class="row gap-37 padding-left-15">
                                <div class="modalFile__abrirBtn"
                                    wire:click="uploadFileModalRespuesta({{ $pregunta->pre_id }})" wire:loading.attr="disabled">
                                    <i class="far fa-paperclip"></i>
                                    @if ($pregunta->respuesta->archivosFormulario->count() > 0)
                                        Adjuntar archivos ({{ $pregunta->respuesta->archivosFormulario->count() }})
                                    @else
                                        Adjuntar archivos
                                    @endif
                                </div>

                                <div class="row-global align-center agregar-comentario cursor-pointer">
                                    <i class="far fa-comment fa-flip-horizontal"></i>
                                    <p>Añadir comentario</p>
                                </div>

                            </div>
                            <div class="row opciones-extras-formulario">
                                @if ($pregunta->pre_obligatorio == 1)
                                    <p class="color-rojo">Obligatoria</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @elseif ($pregunta->tipoPregunta->tipp_id == 2)
                    <div class="div-formulario-n">
                        <h3 class="">{{ $pregunta->pre_pregunta }}</h3>
                        @if ($pregunta->archivosFormulario->count() > 0)
                        <div class="color-texto-cbre bottom-20 cursor-pointer small">
                            <i class="far fa-paperclip"></i>
                            <a href="{{ route('formulario-area-tecnica.archivos', [$formulario->form_id, $pregunta->pre_id]) }}" class="text-decoration-none">Información complementaria</a>
                        </div>
                        @endif
                        @foreach ($pregunta->opciones as $opcion)
                            <div class="row align-center preguntas-preview">
                                <input type="checkbox" wire:model.defer="selectedCheckboxes"
                                    value="{{ $opcion->opc_id }}" wire:click="selectCheckbox({{ $opcion->opc_id }})" wire:loading.attr="disabled">
                                <p>{{ $opcion->opc_opcion }}</p>
                            </div>
                        @endforeach
                        <div class="opciones-pregunta grid-header-2">
                            <div class="row gap-37 padding-left-15">
                                <div class="modalFile__abrirBtn"
                                    wire:click="uploadFileModalRespuesta({{ $pregunta->pre_id }})">
                                    <i class="far fa-paperclip"></i>
                                    @if ($pregunta->respuesta->archivosFormulario->count() > 0)
                                        Adjuntar archivos ({{ $pregunta->respuesta->archivosFormulario->count() }})
                                    @else
                                        Adjuntar archivos
                                    @endif
                                </div>

                                <div class="row-global align-center agregar-comentario cursor-pointer">
                                    <i class="far fa-comment fa-flip-horizontal"></i>
                                    <p>Añadir comentario</p>
                                </div>

                            </div>
                            <div class="row opciones-extras-formulario">
                                @if ($pregunta->pre_obligatorio == 1)
                                    <p class="color-rojo">Obligatoria</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @elseif ($pregunta->tipoPregunta->tipp_id == 3)
                    <div class="div-formulario-n">
                        <h3 class="">{{ $pregunta->pre_pregunta }}</h3>
                        @if ($pregunta->archivosFormulario->count() > 0)
                        <div class="color-texto-cbre bottom-20 cursor-pointer small">
                            <i class="far fa-paperclip"></i>
                            <a href="{{ route('formulario-area-tecnica.archivos', [$formulario->form_id, $pregunta->pre_id]) }}" class="text-decoration-none">Información complementaria</a>
                        </div>
                        @endif
                        <div class="form-group">
                            <textarea name="" id="" class="form-control" cols="30" rows="10" data-maximo-caracteres="2000"
                                wire:model.defer="res_parrafo" wire:change="updateParrafo({{ $pregunta->pre_id }})" wire:loading.attr="disabled"></textarea>
                        </div>
                        <div class="opciones-pregunta grid-header-2">
                            <div class="row gap-37 padding-left-15">
                                <div class="modalFile__abrirBtn"
                                    wire:click="uploadFileModalRespuesta({{ $pregunta->pre_id }})">
                                    <i class="far fa-paperclip"></i>
                                    @if ($pregunta->respuesta->archivosFormulario->count() > 0)
                                        Adjuntar archivos ({{ $pregunta->respuesta->archivosFormulario->count() }})
                                    @else
                                        Adjuntar archivos
                                    @endif
                                </div>

                                <div class="row-global align-center agregar-comentario cursor-pointer">
                                    <i class="far fa-comment fa-flip-horizontal"></i>
                                    <p>Añadir comentario</p>
                                </div>

                            </div>
                            <div class="row opciones-extras-formulario">
                                @if ($pregunta->pre_obligatorio == 1)
                                    <p class="color-rojo">Obligatoria</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @elseif ($pregunta->tipoPregunta->tipp_id == 4)
                    <div class="div-formulario-n">
                        <fieldset class="row row-responsive">
                            <div class="col-xl">
                                <div class="form-group">
                                    <h3 class="">{{ $pregunta->pre_pregunta }}</h3>
                                </div>
                                @if ($pregunta->archivosFormulario->count() > 0)
                                <div class="color-texto-cbre bottom-20 cursor-pointer small">
                                    <i class="far fa-paperclip"></i>
                                    <a href="{{ route('formulario-area-tecnica.archivos', [$formulario->form_id, $pregunta->pre_id]) }}" class="text-decoration-none">Información complementaria</a>
                                </div>
                                @endif
                            </div>
                        </fieldset>
                        <fieldset class="row row-responsive">

                            <div class="col-sm-4 row-column-global sin-margen">
                                <label for="res_mes">Mes de evaluación</label>
                                <div class="form-group">
                                    <select wire:model.defer="res_mes" wire:change="updateHSE({{ $pregunta->pre_id }})" wire:loading.attr="disabled"
                                        id="res_mes" name="res_mes" class="form-control" tabindex="4"
                                        style="width: 100%;">
                                        <option value="">Seleccione</option>
                                        @foreach (range(1, 12) as $mes)
                                            <option value="{{ $mes }}">
                                                {{ ucfirst(\Carbon\Carbon::createFromDate(null, $mes)->locale('es')->monthName) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('res_mes') <span class="text-danger"> {{$message}} </span> @enderror
                                </div>
                            </div>

                            <div class="col-sm-4 row-column-global sin-margen">
                                <label for="anio">Año</label>
                                <div class="form-group">
                                    <select wire:model.defer="res_ano"
                                        wire:change="updateHSE({{ $pregunta->pre_id }})" wire:loading.attr="disabled" id="res_ano"
                                        name="res_ano" class="form-control" tabindex="4" style="width: 100%;">
                                        <option value="">Seleccione</option>
                                        @php
                                            $anioActual = \Carbon\Carbon::now()->year;
                                            $aniosPrevios = range($anioActual - 5, $anioActual);
                                        @endphp
                                        @foreach (array_reverse($aniosPrevios) as $anio)
                                            <option value="{{ $anio }}">{{ $anio }}</option>
                                        @endforeach
                                    </select>
                                    @error('res_ano') <span class="text-danger"> {{$message}} </span> @enderror
                                </div>
                            </div>

                        </fieldset>

                        <h3 class="margin-20">Reporte de accidentabildiad CBRE</h3>

                        <fieldset class="row-global row-responsive">
                            <label class="width-250" for="">Dotación</label>
                            <div class="form-group">
                                <input wire:model.defer="res_dotacion"
                                    wire:change="updateHSE({{ $pregunta->pre_id }})" wire:loading.attr="disabled" id="" name=""
                                    class="form-control" data-maximo-caracteres="50" type="text" tabindex="1" placeholder="">
                                    @error('res_dotacion') <span class="text-danger"> {{$message}} </span> @enderror
                            </div>
                        </fieldset>

                        <fieldset class="row-global row-responsive">
                            <label class="width-250" for="">Reporte de accidentabildiad</label>
                            <div>
                                <input wire:model.defer="res_documento_accidentabilidad"
                                    wire:change="updateHSEfiles({{ $pregunta->pre_id }})" wire:loading.attr="disabled"
                                    class="form-control input-file-nuevo" id=""
                                    name="" type="file" tabindex="1">
                                    @error('res_documento_accidentabilidad') <span class="text-danger"> {{$message}} </span> @enderror
                            </div>
                        </fieldset>

                        <div class="linea-separadora"></div>
                        <h3 class="margin-20">Reporte de accidentabildiad Sub contratos</h3>
                        <fieldset class="row-global row-responsive">
                            <label class="width-250" for="">Dotación sub contratos</label>
                            <div class="form-group">
                                <input wire:model.defer="res_dotacion_sub_contratos"
                                    wire:change="updateHSE({{ $pregunta->pre_id }})" wire:loading.attr="disabled" id="" name=""
                                    class="form-control" data-maximo-caracteres="50" type="text" tabindex="1" placeholder="">
                                    @error('res_dotacion_sub_contratos') <span class="text-danger"> {{$message}} </span> @enderror
                            </div>
                        </fieldset>

                        <fieldset class="row-global row-responsive">
                            <label class="width-250" for="">¿Cuántos de estos son nuevos?</label>
                            <div class="form-group">
                                <input wire:model.defer="res_dotacion_nuevos"
                                    wire:change="updateHSE({{ $pregunta->pre_id }})" wire:loading.attr="disabled" id="" name=""
                                    class="form-control" data-maximo-caracteres="50" type="text" tabindex="1" placeholder="">
                                    @error('res_dotacion_nuevos') <span class="text-danger"> {{$message}} </span> @enderror
                            </div>
                        </fieldset>

                        <fieldset class="row-global row-responsive">
                            <label class="width-250" for="">¿Todos tienen documentación de sub contratación al
                                día?</label>
                            <div class="form-group row-global">
                                <div class="row-global align-center">
                                    <input wire:model.defer="res_documentacion_sub_contrato"
                                        wire:change="updateHSE({{ $pregunta->pre_id }})" wire:loading.attr="disabled" type="radio"
                                        name="sub_contrato" id="sub_contrato" value="1">
                                    <p>Si</p>
                                </div>
                                <div class="row-global align-center">
                                    <input wire:model.defer="res_documentacion_sub_contrato"
                                        wire:change="updateHSE({{ $pregunta->pre_id }})" wire:loading.attr="disabled" type="radio"
                                        name="sub_contrato" id="sub_contrato" value="0">
                                    <p>No</p>
                                </div>
                            </div>
                        </fieldset>
                        @error('res_documentacion_sub_contrato') <span class="text-danger"> {{$message}} </span> @enderror

                        @if ($res_documentacion_sub_contrato == 1)
                        <fieldset class="row-global row-responsive">
                            <label class="width-250" for="">Subir documentación</label>
                            <div>
                                <input wire:model="res_documentacion"
                                    wire:change.defer="updateHSEfiles({{ $pregunta->pre_id }})" wire:loading.attr="disabled"
                                    class="form-control input-file-nuevo" id=""
                                    name="" type="file" tabindex="1">
                                <p style="margin-top: 10px !important;">Subir todos los documentos comprimidos en un
                                    solo
                                    archivo</p>
                            </div>
                        </fieldset>
                        @error('res_documentacion') <span class="text-danger"> {{$message}} </span> @enderror
                        @endif

                        <div class="opciones-pregunta grid-header-2">
                            <div class="row gap-37 padding-left-15">
                                <div class="modalFile__abrirBtn"
                                    wire:click="uploadFileModalRespuesta({{ $pregunta->pre_id }})" wire:loading.attr="disabled">
                                    <i class="far fa-paperclip"></i>
                                    @if ($pregunta->respuesta->archivosFormulario->count() > 0)
                                        Adjuntar archivos ({{ $pregunta->respuesta->archivosFormulario->count() }})
                                    @else
                                        Adjuntar archivos
                                    @endif
                                </div>

                                <div class="row-global align-center agregar-comentario cursor-pointer">
                                    <i class="far fa-comment fa-flip-horizontal"></i>
                                    <p>Añadir comentario</p>
                                </div>

                            </div>
                            <div class="row opciones-extras-formulario">
                                @if ($pregunta->pre_obligatorio == 1)
                                    <p class="color-rojo">Obligatoria</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

    <div class="botones-formulario">
        <a href="{{ route('formulario-jop.deshacer.respuesta') }}"
            class="modalFile__btnN modalFile__botonSecundario text-dark text-decoration-none">Deshacer todos los cambios
        </a>
        <button class="modalEnviar__abrirBtn modalFile__btnN modalFile__botonPrimario"
            id="responder-formulario" wire:click="checkThemAll" wire:loading.remove>Enviar formulario <i class="fas fa-paper-plane"></i>
        </button>
        <button class="modalEnviar__abrirBtn modalFile__btnN modalFile__botonPrimario btn btn-secondary"
        id="responder-formulario" wire:loading wire:loading.attr="disabled" wire:target="checkThemAll">
        Enviar formulario <div class="spinner-border text-small texto-color-cbre"></div>
        </button>
    </div>
    <input type="hidden" id="form_id" name="form_id" value="{{ $formulario->form_id }}">

    @push('scripts')
    <script>
        $(document).ready(function() {
            $('#res_mes').select2('destroy');
            $('#res_ano').select2('destroy');
        });
    </script>
    <script src="{{ asset('public/js/admin/sistema/formularios/responder_formulario.js') }}"></script>
    @endpush


</div>
