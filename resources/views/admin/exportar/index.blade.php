@extends('layout.admin')
@section('title', 'Formulario exportar')

@section('content')
   @push('stylesheets')
      <link rel="stylesheet" href="{{ asset('/public/css/componentes/modal/modal.css') }}">
   @endpush

   <h1>Formulario Exportar</h1>

   <form class="grid-filtros-admin" method="GET">
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
         <label for="">Creado po</label>
         <select id="estado" name="estado" class="form-control" tabindex="4" style="width:100%;">
            <option value="0"></option>
         </select>
         <small id="" class="field-message-alert absolute"></small>
      </div>

      <div>
         <div class="sin-label"></div>
         <button class="btn-filtro" style="height: 34px">Buscar</button>
      </div>

   </form>

   <div class="dx-viewport">
   <div id="dataGridFormulario"></div>

   {{-- Modal Formulario --}}
   @include('components.modalFormulario')

   @csrf
   @endsection
   @push('scripts')
   <script src="{{ asset('public/js/admin/sistema/formulario_exportar/listado.js') }}"></script>
   <script src="{{ asset('/public/css/componentes/modal/modal.js') }}"></script>
   <script src="{{ asset('/public/js/script.js') }}"></script>

   @endpush