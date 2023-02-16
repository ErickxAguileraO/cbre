@extends('layout.admin')
@section('title', 'Noticias')

@section('content')
   <a class="btn btn-primary float-right" href="{{ route('comercios.create') }}">Crear local</a>
   <h1>Locales comerciales</h1>
   <!-- @csrf
   <div class="dx-viewport">
      <div id="dataGridNoticias"></div>
   </div> -->
@endsection

@push('scripts')
<!-- <script src="{{ asset('public/js/admin/sistema/noticias/listado.js') }}"></script> -->
@endpush
