@extends('layout.admin')
@section('title', 'Locales comerciales')

@section('content')
   <a class="btn btn-success float-right text-white" href="{{ route('comercios.create') }}">Crear local</a>
   <h1>Locales comerciales</h1>
   @csrf
   <div class="dx-viewport">
      <div id="dataGridComercios"></div>
   </div>
@endsection

@push('scripts')
<script src="{{ asset('public/js/admin/sistema/comercios/listado.js') }}"></script>
@endpush
