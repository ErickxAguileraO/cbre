@extends('layout.admin')
@section('title', 'Formulario Área técnica')

@section('content')
   <a class="btn btn-success float-right text-white" href="{{ route('formulario-area-tecnica.create') }}">Crear formulario</a>
   <h1>Formulario Área técnica</h1>

    <form class="grid-filtros-admin" method="GET">
        @csrf
      <div class="form-group">
         <label for="">Edificio</label>
         <select id="edificio" name="edificio" class="form-control" tabindex="4" style="width:100%;">
            <option value="">Todos</option> <!-- Opción vacía -->
            @foreach ($edificios as $edificio)
                @php
                    $selected = old('edificio') == $edificio->edi_nombre ? 'selected' : '';
                @endphp
                <option value="{{ $edificio->edi_nombre }}" {{ $selected }}>{{ $edificio->edi_nombre  }}</option>
            @endforeach
         </select>
         <small id="" class="field-message-alert absolute"></small>
     </div>

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
     <input type="hidden" id="rolAdmin" name="rolAdmin" value="{{ auth()->user()->hasRole('super-admin') }}">
      @if (auth()->user()->hasRole('super-admin'))
         <div class="form-group">
            <label for="">Creado por</label>
            <select id="creado_por" name="creado_por" class="form-control" tabindex="4" style="width:100%;">
                <option value="">Todos</option> <!-- Opción vacía -->
                <option value="prevencionista" {{ old('creado_por') === 'prevencionista' ? 'selected' : '' }}>Prevencionista</option>
                <option value="tecnico" {{ old('creado_por') === 'tecnico' ? 'selected' : '' }}>Técnico</option>
                {{-- @if(isset($funcionarios) && !$funcionarios->isEmpty())
                    @foreach ($funcionarios->unique() as $funcionario)
                        @php
                            $selected = old('creado_por') == $funcionario->fun_nombre ? 'selected' : '';
                        @endphp
                        <option value="{{ $funcionario->fun_nombre }}" {{ $selected }}>{{ $funcionario->fun_nombre }}</option>
                    @endforeach
                @endif --}}
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
      <div id="dataGridAreaTecnica"></div>
   </div>
   @csrf
@endsection
@push('scripts')
   <script src="{{ asset('public/js/admin/sistema/area_tecnica/listado.js') }}"></script>
@endpush
