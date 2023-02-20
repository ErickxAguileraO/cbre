@extends('layout.admin')
@section('title', 'Funcionarios')

@section('content')
   <h1>Funcionarios</h1>
   <div class="dx-viewport">
      <div id="dataGridFuncionarios"></div>
   </div>
   @csrf
@endsection
@push('scripts')
   <script src="{{ asset('public/js/admin/sistema/funcionarios/listado.js') }}"></script>
@endpush
