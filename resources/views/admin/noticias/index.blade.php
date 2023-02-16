@extends('layout.admin')
@section('title', 'Noticias')

@section('content')
   <a class="btn btn-primary float-right" href="{{ route('noticias.create') }}">Crear noticia</a>
   <h1>Noticias</h1>
   Aquí va el dataGrid con las noticias.
   <div class="dx-viewport">
      <div id="container-usuarios"></div>
   </div>
@endsection

@push('scripts')
   <script src=""></script>
@endpush
