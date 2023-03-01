@extends('layout.admin')
@section('title', 'Funcionarios')

@section('content')
   @role('super-admin')
      <a class="btn btn-primary float-right" href="{{ route('funcionarios.create') }}">Crear funcionario</a>
   @endrole
   <h1>Funcionarios</h1>
   <div class="dx-viewport">
      <div id="dataGridFuncionarios" data-user-role="{{ auth()->user()->hasRole('super-admin') }}"></div>
   </div>
   @csrf
@endsection
@push('scripts')
   <script src="{{ asset('public/js/admin/sistema/funcionarios/listado.js') }}"></script>
@endpush
