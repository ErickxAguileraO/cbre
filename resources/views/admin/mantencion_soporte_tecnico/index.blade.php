@extends('layout.admin')
@section('title', 'Matenciones Soporte técnico')

@section('content')
   <h1>Mantenciones Soporte técnico</h1>

   <form action="" class="grid-filtros-admin-4">
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
         {{-- <label for="titulo"></label> --}}
         <div class="sin-label"></div>
         <input type="date" class="form-control" min="" id="fechaTermino" name="fechaTermino" placeholder="DD/MM/AAAA">
         <small id="" class="field-message-alert invisible absolute"></small>
      </div>

      <div class="form-group">
         <label for="">Especialidad</label>
         <select id="especialidad" name="especialidad" class="form-control" tabindex="4" style="width:100%;">
            <option value="">Todos</option> <!-- Opción vacía -->
            @foreach ($listadoEspecialidades as $especialidad)
                @php
                    $selected = old('especialidad') == $especialidad->lism_nombre ? 'selected' : '';
                @endphp
                <option value="{{ $especialidad->lism_nombre }}" {{ $selected }}>{{ $especialidad->lism_nombre }}</option>
            @endforeach
         </select>
         <small id="" class="field-message-alert absolute"></small>
     </div>
      <div>
         <div class="sin-label"></div>
         <button class="btn-filtro" style="height: 34px">Buscar</button>
      </div>

   </form>

   <div class="dx-viewport">
      <div id="dataGridSoporteTecnico"></div>
   </div>
   @csrf
@endsection
@push('scripts')
   <script src="{{ asset('public/js/admin/sistema/soporte_tecnico/listado.js') }}"></script>
@endpush
