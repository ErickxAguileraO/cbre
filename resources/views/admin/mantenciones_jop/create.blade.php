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

    <form action="#" method="POST" id="form-caracteristica" class="formulario">
        <div class="form-group bottom-20">
            <label for="">Especialidad</label>
            <select name="" id="" class="col-sm-4"></select>
        </div>

        <div class="form-group bottom-20">
            <label for="">Detallar mantención</label>
            <textarea name="" id="" class="form-control" cols="30" rows="10"
            placeholder="Escriba su respuesta aquí"></textarea>
        </div>

        <div class="form-group bottom-20">
            <label for="">Documentación</label>
            <div>
                <input class="form-control input-file-nuevo col-sm-4" id="" name="" type="file" tabindex="1">
                <p style="margin-top: 10px !important;">Subir todos los documentos comprimidos en un solo
                archivo</p>
            </div>
        </div>

        <div class="botones-formulario" style="justify-content: flex-start;">
            <button class="modalFile__btnN modalFile__botonSecundario">Cancelar</button>
            <div class="modalMantencion__abrirBtn modalFile__btnN modalFile__botonPrimario">Enviar mantención</div>
        </div>

        {{-- Modal enviar --}}
        <div class="contenedor__modalMantencion">
            <div class="modalFile">
                <div class="modalFile__header">
                    <h3>Enviar mantención</h3>
                </div>
                <div class="modalFile__contenedorContenido">
                    <h3 style="text-align: center;">¿Estas seguro de enviar la mantención?</h3>
                </div>

                <div class="modalFile__botones">
                    <div class="modalMantencion__cerrarBtn modalFile__btnN modalFile__botonSecundario">No, revisaré</div>
                    <button class="modalFile__btnN modalFile__botonPrimario">Si, enviar</button>
                </div>

            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script src="{{ asset('/public/js/script.js') }}"></script>
@endpush
