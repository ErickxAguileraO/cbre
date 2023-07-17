@extends('layout.admin')
@section('title', 'Mantenciones JOP')

@section('content')
    @if (!auth()->user()->hasRole('tecnico') && !auth()->user()->hasRole('super-admin'))
        <a class="btn btn-success float-right text-white" href="{{ route('mantenciones-jop.create') }}">Nueva mantención</a>
   @endif
   <h1>Mantenciones JOP</h1>

   <form action="" class="grid-filtros-admin-3">
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
      <div>
         <div class="sin-label"></div>
         <button class="btn-filtro" style="height: 34px">Buscar</button>
      </div>

   </form>

   <div class="dx-viewport">
      <div id="dataGridMantenciones"></div>
   </div>
   @csrf
@endsection
@push('scripts')
   <script src="{{ asset('public/js/admin/sistema/mantenciones/listado.js') }}"></script>
@endpush
