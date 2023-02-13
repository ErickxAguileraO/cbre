@extends('layout.admin')
@section('title', 'Caracteristicas')

@section('content')
   <a class="btn btn-primary float-right" href="{{ route('caracteristicas.create') }}">Crear Caracteristica</a>
   <h1>Caracteristicas</h1>
   <div class="dx-viewport">
      <div id="dataGridCaracteristicas"></div>
   </div>
   @csrf
@endsection
@push('scripts')
   <script src="{{ asset('public/js/admin/sistema/caracteristicas/listado.js') }}"></script>
@endpush
