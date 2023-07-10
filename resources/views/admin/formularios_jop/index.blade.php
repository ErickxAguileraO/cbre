@extends('layout.admin')
@section('title', 'Formularios JOP')

@section('content')
   <h1>Formularios JOP</h1>

   <form action="" class="grid-filtros-admin-3" method="GET">
    @csrf
    <div class="form-group">
        <label for="titulo">Periodo</label>
        <input type="date" class="form-control" min="" id="fechaInicio" name="fechaInicio" placeholder="DD/MM/AAAA">
        <small id="" class="field-message-alert invisible absolute"></small>
     </div>

     <div class="form-group">
        <div class="sin-label"></div>
        <input type="date" class="form-control" min="" id="fechaTermino" name="fechaTermino" placeholder="DD/MM/AAAA">
        <small id="" class="field-message-alert invisible absolute"></small>
     </div>

      <div class="form-group">
         <label for="">Estado</label>
         <select id="estado" name="estado" class="form-control" tabindex="4" style="width:100%;">
            <option value="">Todos</option>
            <option value="4">Borrador</option>
            <option value="1">Publicado</option>
            <option value="2">Respondido</option>
            <option value="3">Cerrado</option>
         </select>
         <small id="" class="field-message-alert absolute"></small>
     </div>
      <div>
         <div class="sin-label"></div>
         <button class="btn-filtro" style="height: 34px">Buscar</button>
      </div>

   </form>

   <div class="dx-viewport">
      <div id="dataGridFormularios"></div>
   </div>
   @csrf
@endsection
@push('scripts')
   <script src="{{ asset('public/js/admin/sistema/formularios/listado.js') }}"></script>
@endpush
