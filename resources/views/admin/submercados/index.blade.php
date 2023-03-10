@extends('layout.admin')
@section('title', 'Submercados')

@section('content')
   <a class="btn btn-success float-right text-white" href="{{ route('submercados.create') }}">Crear Submercado</a>
   <h1>Submercados</h1>
   <div class="dx-viewport">
      <div id="dataGridSubmercados"></div>
   </div>
   @csrf
@endsection
@push('scripts')
   <script src="{{ asset('public/js/admin/sistema/submercados/listado.js') }}"></script>
@endpush
