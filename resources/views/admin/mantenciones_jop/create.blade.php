@extends('layout.admin')
@section('title', 'Crear Mantención')

@section('content')

    @push('stylesheets')
        <link rel="stylesheet" href="{{ asset('/public/css/componentes/modal/modal.css') }}">
    @endpush
    <a href="{{ route('mantenciones-jop.index') }}" class="row row-responsive link-atras">
        <i class="far fa-arrow-left"></i>
        Volver al listado
    </a>
    <h1>Nueva Mantención</h1>

    <form action="#" method="POST" id="form-mantencion" class="formulario">
        @csrf
        <div class="form-group bottom-20">
            <label for="">Especialidad</label>
            <select name="especialidad" id="especialidad" class="col-sm-4">
                <option value="">Seleccione...</option> <!-- Opción vacía -->
                @foreach ($listadoEspecialidades as $especialidad)
                    @php
                        $selected = old('especialidad') == $especialidad->lism_nombre ? 'selected' : '';
                    @endphp
                    <option value="{{ $especialidad->lism_id }}" {{ $selected }}>{{ $especialidad->lism_nombre }}</option>
                @endforeach
            </select>
            <small id="especialidad_error" class="field-message-alert absolute"></small>
        </div>

        <div class="form-group bottom-20">
            <label for="">Detallar mantención</label>
            <textarea name="detalle" id="detalle" class="form-control" cols="30" rows="10"
            placeholder="Escriba su respuesta aquí"></textarea>
            <small id="detalle_error" class="field-message-alert absolute"></small>
        </div>

        <div class="form-group bottom-20">
            <label for="">Documentación</label>
            <div>
                <input class="form-control input-file-nuevo col-sm-4" id="archivo" name="archivo" type="file" tabindex="1">
                <p style="margin-top: 10px !important;">Subir todos los documentos comprimidos en un solo
                archivo</p>
            </div>
            <small id="detalle_error" class="field-message-alert absolute"></small>
        </div>

        <div class="botones-formulario grid2-responsivo" style="justify-content: flex-start;">
            <button type="button" onclick="location.href = '{{ route('mantenciones-jop.index') }}'" class="modalFile__btnN">Cancelar</button>
            <div class="modalMantencion__abrirBtn modalFile__btnN modalFile__botonPrimario">Enviar mantención</div>
        </div>
            {{-- Modal enviar --}}
        <div id="modalMantencion" class="contenedor__modalMantencion">
            <div class="modalFile">
                <div class="modalFile__header">
                    <h3>Enviar mantención</h3>
                </div>
                <div class="modalFile__contenedorContenido">
                    <h3 style="text-align: center;">¿Estas seguro de enviar la mantención?</h3>
                </div>

                <div class="modalFile__botones">
                    <div class="modalMantencion__cerrarBtn modalFile__btnN modalFile__botonSecundario">No, revisaré</div>
                    <button id="guardar" type="submit" value="Guardar" class="modalFile__btnN modalFile__botonPrimario">Si, enviar
                        <div id="loading" class="d-none">
                            <div id="default" class="d-block">
                                <span>Guardar</span>
                                <i class="fas fa-save ml-2 mr-2"></i>
                            </div>
                            <span class="spinner-border spinner-border-md ml-1" role="status" aria-hidden="true"></span>
                        </div>
                    </button>
                 </div>

             </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        // Modal Mantencion
        $(".modalMantencion__abrirBtn").on('click', function () {
        $(".contenedor__modalMantencion").css("display", "flex");
        });

        $(".modalMantencion__cerrarBtn").on('click', function () {
        $(".contenedor__modalMantencion").css("display", "none");
        });
    </script>
    {{-- <script src="{{ asset('/public/js/script.js') }}"></script> --}}
    <script src="{{ asset('public/js/admin/sistema/mantenciones/form_agregar.js') }}"></script>

@endpush
