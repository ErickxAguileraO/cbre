@extends('layout.admin')
@section('title', 'Formularios')

@section('content')
   <h1>Formularios</h1>
   
   <form action="" class="grid-filtros-admin-3">
      <div class="form-group">
         <label for="titulo">Periodo</label>
         <input type="date" class="form-control" min="" id="" name="" placeholder="DD/MM/AAAA">
         <small id="" class="field-message-alert invisible absolute"></small>
      </div>
      
      <div class="form-group">
         <div class="sin-label"></div>
         <input type="date" class="form-control" min="" id="" name="" placeholder="DD/MM/AAAA">
         <small id="" class="field-message-alert invisible absolute"></small>
      </div>

      <div class="form-group">
         <label for="">Estado</label>
         <select id="" name="" class="form-control" tabindex="4" style="width:100%;">
             <option value="1">value 1</option>
             <option value="0">value 2</option>
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
