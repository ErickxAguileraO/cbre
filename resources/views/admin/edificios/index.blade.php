@extends('layout.admin')
@section('title', 'Edificios')

@section('content')
   @role('super-admin')
      <a class="btn btn-primary float-right" href="{{ route('edificios.create') }}">Crear edificio</a>
   @endrole
   <h1>Edificios</h1>
   @csrf
   <div class="dx-viewport">
      <div id="dataGridEdificios" data-user-role="{{ auth()->user()->hasRole('super-admin') }}"></div>
   </div>
@endsection

@push('scripts')
<script src="{{ asset('public/js/admin/sistema/edificios/listado.js') }}"></script>
@endpush
