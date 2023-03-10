@extends('layout.admin')
@section('title', 'Administradores')

@section('content')
   <a class="btn btn-success float-right text-white" href="{{ route('administradores.create') }}">Crear Administrador</a>
   <h1>Administradores</h1>
   <div class="dx-viewport">
      <div id="dataGridAdministradores"></div>
   </div>
   @csrf
@endsection
@push('scripts')
   <script src="{{ asset('public/js/admin/sistema/administradores/listado.js') }}"></script>
@endpush
