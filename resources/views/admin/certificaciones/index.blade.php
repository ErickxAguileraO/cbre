@extends('layout.admin')
@section('title', 'Certificaciones')

@section('content')
   <a class="btn btn-primary float-right" href="{{ route('certificaciones.create') }}">Crear certificación</a>
   <h1>Certificaciones</h1>
   @csrf
   <div class="dx-viewport">
      <div id="dataGridCertificaciones"></div>
   </div>
@endsection

@push('scripts')
   <script src="{{ asset('public/js/admin/sistema/certificaciones/listado.js') }}"></script>
@endpush
