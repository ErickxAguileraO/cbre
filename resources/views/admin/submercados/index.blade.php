@extends('layout.admin')
@section('title', 'Submercados')

@section('content')
   <a class="btn btn-primary float-right" href="{{ route('submercados.create') }}">Crear Submercado</a>
   <h1>Submercados</h1>
   <div class="dx-viewport">
      <div id="dataGridSubmercados"></div>
   </div>
   @csrf
@endsection
@push('scripts')
   <script src="{{ asset('public/js/admin/sistema/submercados/listado.js') }}"></script>
@endpush
