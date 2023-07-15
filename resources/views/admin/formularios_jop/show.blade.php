@extends('layout.admin')
@section('title', 'Responder formulario')
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

<livewire:administracion.formulario.reply-form :formId="$formulario->form_id"/>

@endsection

@push('scripts')
{{-- <script src="{{ asset('public\js\admin\sistema\caracteristicas\form_agregar.js') }}"></script>
<script src="{{ asset('/public/css/componentes/tab/tab.js') }}"></script>
<script src="{{ asset('/public/css/componentes/modal/modal.js') }}"></script>
<script src="{{ asset('/public/js/script.js') }}"></script> --}}
@endpush
