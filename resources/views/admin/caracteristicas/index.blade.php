@extends('layout.admin')
@section('title', 'Caracteristicas')

@section('content')
    <a class="btn btn-primary float-right" href="{{ route('caracteristicas.create') }}">Crear Característica</a>
    <h1>Características</h1>
    <div class="dx-viewport demo-container">
        <div id="container"></div>
    </div>
@endsection
@csrf
@push('scripts')
    <script>
        $(document).ready(function(e) {
            DevExpress.localization.locale(navigator.language);
            $('#container').dxDataGrid({
                dataSource: "{{ route('caracteristicas.list') }}",
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
                        dataField: 'car_nombre',
                        caption: 'Nombre',
                        filterOperations: ["contains"],
                        alignment: 'center',
                        hidingPriority: 3, // prioridad para ocultar columna, 0 se oculta primero
                    },
                    {
                        dataField: 'car_posicion',
                        caption: 'Posicion',
                        filterOperations: ["contains"],
                        alignment: 'center',
                        hidingPriority: 3, // prioridad para ocultar columna, 0 se oculta primero
                    },
                    {
                        dataField: 'car_estado',
                        caption: 'Estado',
                        allowEditing: false,
                        // width:300,
                        lookup: {
                            dataSource: {
                                store: {
                                    type: 'array',
                                    data: [{
                                            id: 0,
                                            name: 'Inactivo'
                                        },
                                        {
                                            id: 1,
                                            name: 'Activo'
                                        },
                                    ],
                                    key: "id"
                                },
                            },
                            valueExpr: 'id',
                            displayExpr: 'name'
                        },
                    },
                    {
                        dataField: '',
                        caption: 'Opciones',
                        alignment: 'center',
                        hidingPriority: 4, // prioridad para ocultar columna, 0 se oculta primero

                        cellTemplate(container, options) {

                            var route_edit =
                                '{{ route('caracteristicas.edit', ':section') }}';
                            var url_edit = route_edit.replace(':section', options.data.car_id);

                            var route_delete =
                                '{{ route('caracteristicas.destroy', ':section') }}';
                            var url_delete = route_delete.replace(':section', options.data.car_id);

                            return $('<a href="' + url_edit +
                                '" class="edit" style="color: #DD5702; font-size: 20px; margin-right:10px;"><i class="fas fa-edit"></i></a>  <a class="eliminar_pedido" href="#" data-id="' +
                                options.data.sec_id + '" onclick=eliminar("' + url_delete +
                                '") style="color: #DD5702; font-size: 20px;"><i class="fas fa-trash"></i></a>'
                            );

                        },
                    },
                ],
            });
        });
    </script>
@endpush

@push('scripts')
    <script src="{{ asset('public\js\admin\caracteristicas\caracteristica.js') }}"></script>
@endpush
