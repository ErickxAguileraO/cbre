@extends('layout.web')
@section('title', 'Caracteristicas')

@section('content')
   <h1>Clientes</h1>
   <div class="dx-viewport demo-container">
      <div id="container-usuarios"></div>
   </div>
@endsection

@push('scripts')
   <script>
      $(document).ready(function(e) {
         DevExpress.localization.locale(navigator.language);
         $('#container-usuarios').dxDataGrid({
            dataSource: "{{ route('caracteristica.list') }}",
            columnAutoWidth: true,
            showBorders: true, // mostrar bordes de la tabla
            hoverStateEnabled: true, // color en la fila al pasar el mouse por encima
            columnHidingEnabled: true, // ocultar columnas si no alcanzan a desplegarse en la resolucion
            allowColumnReordering: true, // permite mover las columnas (cambiar de orden) al actualizar vuelve a la normalidad
            // rowAlternationEnabled: true, // fila de color intercalada
            wordWrapEnabled: true, // permite visualizar todo el texto en una columna (pasa la siguiente, como si hiciera enter)
            searchPanel: { // 1 panel para buscar palabras
               visible: true,
               width: 240,
               placeholder: 'Buscar...',
            },
            headerFilter: { // filtro para filtrar al seleccionar valores de la columna en la cabecera
               visible: true,
            },
            filterRow: { //lupita para buscar en columna
               visible: true,
               applyFilter: 'auto', // puede ser auto u onClick
               betweenStartText: 'Inicio',
               betweenEndText: 'Fin',
            },
            pager: { // paginador, cuantas filas se muestran
               allowedPageSizes: [10, 25, 50, 100],
               showInfo: true,
               showNavigationButtons: true,
               showPageSizeSelector: true,
               visible: 'auto',
            },
            paging: { // numero de filas a mostrar
               pageSize: 10,
            },
            columnChooser: { // escoger que columnas se muestran u ocultar al presionar un botón y seleccionar
               enabled: false,
               mode: 'select',
            },
            columns: [
               // filtro en cabecera para NUMERIC filterOperations:[ "=", "<>", "<", ">", "<=", ">=", "between" ],
               // filtro en cabecera para STRING filterOperations:[ "contains", "notcontains", "startswith", "endswith", "=", "<>" ],
               // filtro en cabecera para DATE filterOperations:[ "=", "<>", "<", ">", "<=", ">=", "between" ],
               // en caso de tener 2 o más filtros, para dejar uno por defecto se usa selectedFilterOperation: "between",
               {
                  dataField: 'usuv_nombre',
                  caption: 'Nombre',
                  filterOperations: ["contains"],
                  hidingPriority: 3, // prioridad para ocultar columna, 0 se oculta primero
               },
               {
                  dataField: 'usuv_correo',
                  caption: 'Correo',
                  filterOperations: ["contains"],
                  hidingPriority: 3, // prioridad para ocultar columna, 0 se oculta primero
               },
               {
                  dataField: 'usuv_rut',
                  caption: 'Rut',
                  filterOperations: ["contains"],
                  hidingPriority: 3, // prioridad para ocultar columna, 0 se oculta primero
               },
               {
                  dataField: '',
                  caption: 'Opciones',
                  alignment: 'center',
                  hidingPriority: 4, // prioridad para ocultar columna, 0 se oculta primero

                  cellTemplate(container, options) {
                     const url_change_status = '{{ route('caracteristica.destroy', ':id') }}'.replace(':id', options.data.car_id);
                     const url_edit = '{{ route('caracteristica.edit', ':id') }}'.replace(':id', options.data.car_id);

                     const icon_edit = "<a class='text-primary mr-2' href='" + url_edit + "'><i class='fas fa-pencil fa-fw'></i></a>";
                     const icon_delete = "<a class='text-danger delete-confirmation' data-message='este cliente' href='" + url_change_status + "'><i class='fas fa-trash-can fa-fw pointer-none'></i></a>";

                     return $('<div>').append(icon_edit);
                  },
               },
            ],
         });
      });
   </script>
@endpush
