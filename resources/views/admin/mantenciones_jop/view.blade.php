@extends('layout.admin')
@section('title', 'Mantencion detalle')

@section('content')

    @push('stylesheets')
        <link rel="stylesheet" href="{{ asset('/public/css/componentes/modal/modal.css') }}">
    @endpush
    <a href="{{ route('mantenciones-jop.index') }}" class="row row-responsive link-atras">
        <i class="far fa-arrow-left"></i>
        Volver al listado
    </a>
    <h1>Mantención</h1>

    <div id="form-caracteristica" class="formulario">
        <div class="form-group bottom-20">
            <label for="">Especialidad</label>
            <input type="text" disabled value="{{ $listadoEspecialidades->lism_nombre }}" class="col-sm-4 form-control">
        </div>

        <div class="form-group bottom-20">
            <label for="">Detalle mantención</label>
            <textarea disabled name="" id="" class="form-control" cols="30" rows="10">{{ $mantencion->man_descripcion }}</textarea>
        </div>

        <div class="form-group bottom-20">
            <label for="">Documentación</label>
            <div>
                <input type="text" class="form-control input-file-txt-nuevo col-sm-4" readonly>
                <a href="{{ route('mantenciones-jop.archivos', [$mantencion->man_id]) }}" download><i class="fas fa-download"></i> Descargar archivo</a>
                {{-- <input class="form-control input-file-nuevo col-sm-4" id="" name="" type="file" tabindex="1"> --}}
                {{-- <p style="margin-top: 10px !important;">Subir todos los documentos comprimidos en un solo
                archivo</p> --}}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('/public/js/script.js') }}"></script>
@endpush
