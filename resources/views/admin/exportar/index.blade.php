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

      @if (auth()->user()->hasRole('super-admin'))
      <div class="form-group">
          <label for="">Creado por</label>
          <select id="creado_por" name="creado_por" class="form-control" tabindex="4" style="width:100%;">
              <option value="">Todos</option> <!-- Opción vacía -->
              <option value="Prevencionista">Prevencionista</option>
              <option value="Técnico">Técnico</option>
          </select>
          <small id="" class="field-message-alert absolute"></small>
      </div>
      @endif

      <div>
         <div class="sin-label"></div>
         <button class="btn-filtro" style="height: 34px">Buscar</button>
      </div>

   </form>

   <div class="dx-viewport">
   <div id="dataGridExportar"></div>


{{-- Modal Publicar --}}
<div class="contenedor__modalFormulario">
    <div class="modalFile">
        <div class="modalFile__header">
            <h3>Edificios</h3>
        </div>
        <div class="modalFile__contenedorContenido">
            <p>Formulario: <span id="formularioNombre"></span></p>
            <div class="modalFile__contenido">
                <div class="tabla-archivos-subidos" id="edificiosList">
                    <!-- Aquí se agregarán los edificios -->
                </div>
            </div>
        </div>
        <div class="modalFile__botones">
            <div class="modalFormulario__cerrarBtn modalFile__btnN modalFile__botonSecundario">Cerrar</div>
        </div>
    </div>
</div>

   {{-- Modal Formulario --}}
   {{-- @include('components.modalFormulario') --}}

   @csrf
   @endsection
   @push('scripts')
    <script>
        $(".modalFormulario__abrirBtn").on('click', function () {
        $(".contenedor__modalFormulario").css("display", "flex");
        });

        $(".modalFormulario__cerrarBtn").on('click', function () {
        $(".contenedor__modalFormulario").css("display", "none");
        });
    </script>

   <script src="{{ asset('public/js/admin/sistema/formulario_exportar/listado.js') }}"></script>
   <script src="{{ asset('/public/css/componentes/modal/modal.js') }}"></script>
   <script src="{{ asset('/public/js/script.js') }}"></script>

   @endpush
