@extends('layout.admin')
@section('title', 'Contactos')

@section('content')
   <h1>Contactos</h1>
   <div class="dx-viewport">
      <div id="dataGridContactos"></div>
   </div>
   @csrf
@endsection
@push('scripts')
   <script src="{{ asset('public/js/admin/sistema/contactos/listado.js') }}"></script>
@endpush
