@extends('layout.admin')
@section('title', 'Caracteristicas')

@section('content')
   <a class="btn btn-success float-right text-white" href="{{ route('caracteristicas.create') }}">Crear Característica</a>
   <h1>Características</h1>
   <div class="dx-viewport">
      <div id="dataGridCaracteristicas"></div>
   </div>
   @csrf
@endsection
@push('scripts')
   <script src="{{ asset('public/js/admin/sistema/caracteristicas/listado.js') }}"></script>
@endpush
