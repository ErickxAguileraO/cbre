@extends('layout.admin')
@section('title', 'Mantencion detalle')

@section('content')

    @push('stylesheets')
        <link rel="stylesheet" href="{{ asset('/public/css/componentes/modal/modal.css') }}">
    @endpush
    <a href="/mantencion-soporte-tecnico" class="row row-responsive link-atras">
        <i class="far fa-arrow-left"></i>
        Volver al listado
    </a>
    <h1 style="margin: 0px;">Mantención “Electricidad”</h1>
    <p style="margin-bottom: 30px !important;">Creada el 21 Nov 2023</p>

    <div id="form-caracteristica" class="formulario">
        <div class="form-group bottom-20">
            <label for="">Especialidad</label>
            <input type="text" class="col-sm-4 form-control">
        </div>

        <div class="form-group bottom-20">
            <label for="">Detalle mantención</label>
            <textarea name="" id="" class="form-control" cols="30" rows="10"></textarea>
        </div>

        <div class="form-group bottom-20">
            <label for="">Documentación</label>
            <div>
                <input type="text" class="form-control input-file-txt-nuevo col-sm-4">
                {{-- <input class="form-control input-file-nuevo col-sm-4" id="" name="" type="file" tabindex="1"> --}}
                <p style="margin-top: 10px !important;">Subir todos los documentos comprimidos en un solo
                archivo</p>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('/public/js/script.js') }}"></script>
@endpush
