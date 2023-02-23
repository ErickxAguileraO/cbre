@extends('layout.admin')
@section('title', 'Edificios')

@section('content')
   <a class="btn btn-primary float-right" href="{{ route('edificios.create') }}">Crear edificio</a>
   <h1>Edificios</h1>
   @csrf
   <div class="dx-viewport">
      <div id="dataGridEdificios"></div>
   </div>
@endsection

@push('scripts')
<script src="{{ asset('public/js/admin/sistema/edificios/listado.js') }}"></script>
@endpush
