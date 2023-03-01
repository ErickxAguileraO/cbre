@extends('layout.admin')
@section('title', 'Funcionarios')

@section('content')
<a class="btn btn-primary float-right" href="{{ route('funcionarios.create') }}">Crear funcionario</a>
   <h1>Funcionarios</h1>
   <div class="dx-viewport">
      <div id="dataGridFuncionarios"></div>
   </div>
   @csrf
@endsection
@push('scripts')
   <script src="{{ asset('public/js/admin/sistema/funcionarios/listado.js') }}"></script>
@endpush
