<div>

    <livewire:administracion.formulario.upload-file-modal/>

    <div class="div-formulario-n">
        <h3>Información del formulario</h3>
        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="">Nombre formulario</label>
                    <input id="form_nombre" name="form_nombre" wire:model.defer="form_nombre" wire:change="updateFormInfo()" class="form-control" data-maximo-caracteres="50" type="text" tabindex="1" />
                    @error('form_nombre') <span class="text-danger"> {{$message}} </span> @enderror
                </div>
            </div>
        </fieldset>

        <fieldset class="row">
            <div class="col-xl">
                <div class="form-group">
                    <label for="">Descripción</label>
                    <textarea name="form_descripcion" id="form_descripcion" wire:model.defer="form_descripcion" wire:change="updateFormInfo()" class="form-control" data-maximo-caracteres="2000" cols="30" rows="10"></textarea>
                    <small id="" class="field-message-alert absolute"></small>
                </div>
            </div>
        </fieldset>
    </div>

    <div>

        @foreach ($formulario->preguntas as $index => $pregunta)
        @if ($pregunta->tipoPregunta->tipp_id == 1)

            {{-- Seleccion individual --}}
            <div class="div-formulario-n">
                {{-- Encabezado de pregunta --}}
                <fieldset class="row row-responsive">
                    <div class="col-xl">
                        <div class="form-group">
                            <input id="" name="" wire:model.defer="pre_pregunta.{{$pregunta->pre_id}}" wire:change="updatePreguntaTitle({{ $pregunta->pre_id }})" class="form-control" data-maximo-caracteres="50" type="text" tabindex="1" placeholder="Pregunta" />
                            <small id="" class="field-message-alert absolute"></small>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <select id="" name="" class="form-control" tabindex="4"
                                style="width:100%;">
                                <option wire:click="changePreguntaType({{ $pregunta->pre_id }},{{ 1 }})"
                                    value="Selección individual">Seleccion individual</option>
                                <option wire:click="changePreguntaType({{ $pregunta->pre_id }},{{ 2 }})"
                                    value="Selección múltiple">Selección múltiple</option>
                                <option wire:click="changePreguntaType({{ $pregunta->pre_id }},{{ 3 }})"
                                    value="Párrafo">
                                    Párrafo</option>
                                <option wire:click="changePreguntaType({{ $pregunta->pre_id }},{{ 4 }})"
                                    value="HSE - Accidentabilidad">HSE - Accidentabilidad</option>
                            </select>
                            <small id="" class="field-message-alert absolute"></small>
                        </div>
                    </div>
                </fieldset>
                {{-- Input dinamico --}}
                <div class="contenedor-dinamico">
                    @foreach ($pregunta->opciones as $index => $opcion)
                    <fieldset class="row row-input-form">
                        <input type="radio" disabled>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input id="" name="" wire:model.defer="opc_opcion.{{$opcion->opc_id}}" wire:change="updateOptionTitle({{ $opcion->opc_id }})" class="form-control" data-maximo-caracteres="50" type="text" tabindex="1"
                                    placeholder="Opción" />
                            </div>
                        </div>
                        @if ($index >= 1)
                            <img wire:click="deleteOption({{$opcion->opc_id}})" src="/public/images/admin/sistema/delete.svg" class="btn btn-remove" alt="">
                        @endif
                    </fieldset>
                @endforeach
                </div>

                <div wire:click="addNewOption({{$pregunta->pre_id}})" class="btn-agregar row-global cursor-pointer color-texto-cbre">
                    <i class="far fa-plus-circle"></i>
                    <p>Añadir otra opción</p>
                </div>

                {{-- Opciones de la pregunta --}}
                <div class="opciones-pregunta grid-header-2">
                    <div class="modalFile__abrirBtn" wire:click="uploadFileModal({{$pregunta->pre_id}})">
                        <i class="far fa-paperclip"></i>
                        @if ($pregunta->archivosFormulario->count() > 0)
                        Adjuntar archivos ({{$pregunta->archivosFormulario->count()}})
                        @else
                        Adjuntar archivos
                        @endif
                    </div>
                    <div class="row opciones-extras-formulario">
                        <div class="row-global align-center">
                            <p>Obligatorio</p>

                            @if ($pregunta->pre_obligatorio == 1)
                            <p wire:click="switchPreguntaRequired({{$pregunta->pre_id}})" class="pointer">
                                <i class="fas fa-toggle-on color-texto-cbre fa-2x"></i>
                            </p>
                            @else
                            <p wire:click="switchPreguntaRequired({{$pregunta->pre_id}})" class="pointer">
                                <i class="fas fa-toggle-off text-danger fa-2x"></i>
                            </p>
                            @endif

                        </div>
                        <div wire:click="deletePregunta({{ $pregunta->pre_id }})" class="btn-remove-pregunta">
                            <p>Eliminar pregunta</p>
                            <img src="/public/images/admin/sistema/delete.svg" class="btn-remove" alt="">
                        </div>
                    </div>
                </div>
            </div>

        @elseif ($pregunta->tipoPregunta->tipp_id == 2)

            {{-- Seleccion multiple --}}
            <div class="div-formulario-n">
                {{-- Encabezado de pregunta --}}
                <fieldset class="row row-responsive">
                    <div class="col-xl">
                        <div class="form-group">
                            <input id="" name="" wire:model.defer="pre_pregunta.{{$pregunta->pre_id}}" wire:change="updatePreguntaTitle({{ $pregunta->pre_id }})" class="form-control" data-maximo-caracteres="50" type="text" tabindex="1" placeholder="Pregunta" />
                            <small id="" class="field-message-alert absolute"></small>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <select id="" name="" class="form-control" tabindex="4"
                                style="width:100%;">
                                <option wire:click="changePreguntaType({{ $pregunta->pre_id }},{{ 1 }})"
                                    value="Selección individual">Seleccion individual</option>
                                <option wire:click="changePreguntaType({{ $pregunta->pre_id }},{{ 2 }})"
                                    value="Selección múltiple">Selección múltiple</option>
                                <option wire:click="changePreguntaType({{ $pregunta->pre_id }},{{ 3 }})"
                                    value="Párrafo">
                                    Párrafo</option>
                                <option wire:click="changePreguntaType({{ $pregunta->pre_id }},{{ 4 }})"
                                    value="HSE - Accidentabilidad">HSE - Accidentabilidad</option>
                            </select>
                            <small id="" class="field-message-alert absolute"></small>
                        </div>
                    </div>
                </fieldset>

                {{-- Input dinamico --}}
                <div class="contenedor-dinamico">
                    @foreach ($pregunta->opciones as $index => $opcion)
                    <fieldset class="row row-input-form">
                        <input type="checkbox" disabled>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input id="" name="" wire:model.defer="opc_opcion.{{$opcion->opc_id}}" wire:change="updateOptionTitle({{ $opcion->opc_id }})" class="form-control" data-maximo-caracteres="50" type="text"
                                    tabindex="1" placeholder="Opción" />
                            </div>
                        </div>
                        @if ($index >= 1)
                        <img wire:click="deleteOption({{$opcion->opc_id}})" src="/public/images/admin/sistema/delete.svg" class="btn btn-remove" alt="">
                        @endif
                    </fieldset>
                    @endforeach
                </div>


                <div wire:click="addNewOption({{$pregunta->pre_id}})" class="btn-agregar row-global cursor-pointer color-texto-cbre">
                    <i class="far fa-plus-circle"></i>
                    <p>Añadir otra opción</p>
                </div>

                {{-- Opciones de la pregunta --}}
                <div class="opciones-pregunta grid-header-2">
                    <div class="modalFile__abrirBtn" wire:click="uploadFileModal({{$pregunta->pre_id}})">
                        <i class="far fa-paperclip"></i>
                        @if ($pregunta->archivosFormulario->count() > 0)
                        Adjuntar archivos ({{$pregunta->archivosFormulario->count()}})
                        @else
                        Adjuntar archivos
                        @endif
                    </div>
                    <div class="row opciones-extras-formulario">
                        <div class="row-global align-center">
                            <p>Obligatorio</p>

                            @if ($pregunta->pre_obligatorio == 1)
                            <p wire:click="switchPreguntaRequired({{$pregunta->pre_id}})" class="pointer">
                                <i class="fas fa-toggle-on color-texto-cbre fa-2x"></i>
                            </p>
                            @else
                            <p wire:click="switchPreguntaRequired({{$pregunta->pre_id}})" class="pointer">
                                <i class="fas fa-toggle-off text-danger fa-2x"></i>
                            </p>
                            @endif

                        </div>
                        <div wire:click="deletePregunta({{ $pregunta->pre_id }})" class="btn-remove-pregunta">
                            <p>Eliminar pregunta</p>
                            <img src="/public/images/admin/sistema/delete.svg" class="btn-remove" alt="">
                        </div>
                    </div>
                </div>
            </div>

        @elseif ($pregunta->tipoPregunta->tipp_id == 3)

            {{-- Parrafo --}}
            <div class="div-formulario-n">
                {{-- Encabezado de pregunta --}}
                <fieldset class="row row-responsive">
                    <div class="col-xl">
                        <div class="form-group">
                            <input id="" name="" wire:model.defer="pre_pregunta.{{$pregunta->pre_id}}" wire:change="updatePreguntaTitle({{ $pregunta->pre_id }})" class="form-control" data-maximo-caracteres="50" type="text" tabindex="1" placeholder="Pregunta" />
                            <small id="" class="field-message-alert absolute"></small>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <select id="" name="" class="form-control" tabindex="4"
                                style="width:100%;">
                                <option wire:click="changePreguntaType({{ $pregunta->pre_id }},{{ 1 }})"
                                    value="Selección individual">Seleccion individual</option>
                                <option wire:click="changePreguntaType({{ $pregunta->pre_id }},{{ 2 }})"
                                    value="Selección múltiple">Selección múltiple</option>
                                <option wire:click="changePreguntaType({{ $pregunta->pre_id }},{{ 3 }})"
                                    value="Párrafo">
                                    Párrafo</option>
                                <option wire:click="changePreguntaType({{ $pregunta->pre_id }},{{ 4 }})"
                                    value="HSE - Accidentabilidad">HSE - Accidentabilidad</option>
                            </select>
                            <small id="" class="field-message-alert absolute"></small>
                        </div>
                    </div>
                </fieldset>
                <div class="form-group">
                    <textarea name="" id="" class="form-control" disabled cols="30" rows="10" placeholder="Respuesta" data-maximo-caracteres="2000"></textarea>
                    <small id="" class="field-message-alert absolute"></small>
                </div>

                {{-- Opciones de la pregunta --}}
                <div class="opciones-pregunta grid-header-2">
                    <div class="modalFile__abrirBtn" wire:click="uploadFileModal({{$pregunta->pre_id}})">
                        <i class="far fa-paperclip"></i>
                        @if ($pregunta->archivosFormulario->count() > 0)
                        Adjuntar archivos ({{$pregunta->archivosFormulario->count()}})
                        @else
                        Adjuntar archivos
                        @endif
                    </div>
                    <div class="row opciones-extras-formulario">
                        <div class="row-global align-center">
                            <p>Obligatorio</p>

                            @if ($pregunta->pre_obligatorio == 1)
                            <p wire:click="switchPreguntaRequired({{$pregunta->pre_id}})" class="pointer">
                                <i class="fas fa-toggle-on color-texto-cbre fa-2x"></i>
                            </p>
                            @else
                            <p wire:click="switchPreguntaRequired({{$pregunta->pre_id}})" class="pointer">
                                <i class="fas fa-toggle-off text-danger fa-2x"></i>
                            </p>
                            @endif

                        </div>
                        <div wire:click="deletePregunta({{ $pregunta->pre_id }})" class="btn-remove-pregunta">
                            <p>Eliminar pregunta</p>
                            <img src="/public/images/admin/sistema/delete.svg" class="btn-remove" alt="">
                        </div>
                    </div>
                </div>
            </div>

        @elseif ($pregunta->tipoPregunta->tipp_id == 4)

            {{-- HSE - Accidentabilidad --}}
            <div class="div-formulario-n">
                {{-- Encabezado de pregunta --}}
                <fieldset class="row row-responsive">
                    <div class="col-xl">
                        <div class="form-group">
                            <input id="" name="" wire:model.defer="pre_pregunta.{{$pregunta->pre_id}}" wire:change="updatePreguntaTitle({{ $pregunta->pre_id }})" class="form-control" data-maximo-caracteres="50" type="text" tabindex="1" placeholder="Pregunta" />
                            <small id="" class="field-message-alert absolute"></small>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <select id="" name="" class="form-control" tabindex="4"
                                style="width:100%;">
                                <option wire:click="changePreguntaType({{ $pregunta->pre_id }},{{ 1 }})"
                                    value="Selección individual">Seleccion individual</option>
                                <option wire:click="changePreguntaType({{ $pregunta->pre_id }},{{ 2 }})"
                                    value="Selección múltiple">Selección múltiple</option>
                                <option wire:click="changePreguntaType({{ $pregunta->pre_id }},{{ 3 }})"
                                    value="Párrafo">
                                    Párrafo</option>
                                <option wire:click="changePreguntaType({{ $pregunta->pre_id }},{{ 4 }})"
                                    value="HSE - Accidentabilidad">HSE - Accidentabilidad</option>
                            </select>
                            <small id="" class="field-message-alert absolute"></small>
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
                        <input id="" name="" class="form-control" data-maximo-caracteres="50" type="text" tabindex="1"
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
                        <input id="" name="" class="form-control" data-maximo-caracteres="50" type="text" tabindex="1"
                            placeholder="" disabled>
                    </div>
                </fieldset>

                <fieldset class="row-global row-responsive">
                    <label class="width-250" for="">¿Cuántos de estos son nuevos?</label>
                    <div class="form-group">
                        <input id="" name="" class="form-control" data-maximo-caracteres="50" type="text" tabindex="1"
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

                <div class="opciones-pregunta grid-header-2">
                    <div class="modalFile__abrirBtn" wire:click="uploadFileModal({{$pregunta->pre_id}})">
                        <i class="far fa-paperclip"></i>
                        @if ($pregunta->archivosFormulario->count() > 0)
                        Adjuntar archivos ({{$pregunta->archivosFormulario->count()}})
                        @else
                        Adjuntar archivos
                        @endif
                    </div>
                    <div class="row opciones-extras-formulario">
                        <div class="row-global align-center">
                            <p>Obligatorio</p>

                            @if ($pregunta->pre_obligatorio == 1)
                            <p wire:click="switchPreguntaRequired({{$pregunta->pre_id}})" class="pointer">
                                <i class="fas fa-toggle-on color-texto-cbre fa-2x"></i>
                            </p>
                            @else
                            <p wire:click="switchPreguntaRequired({{$pregunta->pre_id}})" class="pointer">
                                <i class="fas fa-toggle-off text-danger fa-2x"></i>
                            </p>
                            @endif

                        </div>
                        <div wire:click="deletePregunta({{ $pregunta->pre_id }})" class="btn-remove-pregunta">
                            <p>Eliminar pregunta</p>
                            <img src="/public/images/admin/sistema/delete.svg" class="btn-remove" alt="">
                        </div>
                    </div>
                </div>
            </div>

        @endif
    @endforeach
    </div>

    <div wire:click="createNewPregunta" class="btn-agregar-nueva-pregunta">
        <i class="far fa-plus-circle"></i>
        <p>Agregar nueva pregunta</p>
    </div>

</div>

@push('scripts')

@endpush
</div>
