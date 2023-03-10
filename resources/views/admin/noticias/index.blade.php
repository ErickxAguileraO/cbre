@extends('layout.admin')
@section('title', 'Noticias')

@section('content')
   <a class="btn btn-success float-right text-white" href="{{ route('noticias.create') }}">Crear noticia</a>
   <h1>Noticias</h1>
   @csrf
   <div class="dx-viewport">
      <div id="dataGridNoticias"></div>
   </div>
@endsection

@push('scripts')
<script src="{{ asset('public/js/admin/sistema/noticias/listado.js') }}"></script>
@endpush
