
document.addEventListener("DOMContentLoaded", function () {
    cargarFormulario();

    function cargarFormulario() {
        DevExpress.localization.locale(navigator.language);

        // Función para el origen de datos.
        const formulario = new DevExpress.data.CustomStore({
            load: function (loadOptions) {
                const params = {
                    fechaInicio: document.querySelector('#fechaInicio').value,
                    fechaTermino: document.querySelector('#fechaTermino').value,
                    estado: document.querySelector('#estado').value,
                };

                return sendRequest("/admin/formulario-area-tecnica/get/list", "GET", params);
            },
        });



        const dataGrid = $("#dataGridAreaTecnica").dxDataGrid({
            dataSource: formulario,
            // Resto del código del data grid...
            columns: [
                {
                    dataField: "form_nombre",
                    caption: "Área",
                    filterOperations: ["contains"],
                    alignment: "left",
                    hidingPriority: 3, // prioridad para ocultar columna, 0 se oculta primero
                },
                {
                    dataField: "form_nombre",
                    caption: "Nombre formulario",
                    filterOperations: ["contains"],
                    alignment: "left",
                    hidingPriority: 3, // prioridad para ocultar columna, 0 se oculta primero
                    // width: '110',
                    // minWidth: '110',
                },
                {
                    dataField: "fecha",
                    caption: "Fecha de envío",
                    filterOperations: ["contains"],
                    alignment: "left",
                    hidingPriority: 3, // prioridad para ocultar columna, 0 se oculta primero
                    // width: '110',
                    // minWidth: '110',
                },
                {
                    dataField: "form_nombre",
                    caption: "Edificio",
                    filterOperations: ["contains"],
                    alignment: "left",
                    hidingPriority: 3, // prioridad para ocultar columna, 0 se oculta primero
                    // width: '110',
                    // minWidth: '110',
                },
                {
                    dataField: "form_nombre",
                    caption: "Archivos",
                    filterOperations: ["contains"],
                    alignment: "left",
                    hidingPriority: 3, // prioridad para ocultar columna, 0 se oculta primero
                    // width: '110',
                    // minWidth: '110',
                },
                {
                    dataField: "form_estado",
                    caption: "Estado",
                    allowEditing: false,
                    hidingPriority: 3, // prioridad para ocultar columna, 0 se oculta primero
                    // width: '100',
                    // minWidth: '100',
                    // width:300,
                    lookup: {
                        dataSource: {
                            store: {
                                type: "array",
                                data: [
                                    {
                                        id: 0,
                                        name: "Borrador",
                                    },
                                    {
                                        id: 1,
                                        name: "Publicado",
                                    },
                                    {
                                        id: 2,
                                        name: "Respondido",
                                    },
                                    {
                                        id: 3,
                                        name: "Cerrado",
                                    },
                                ],
                                key: "id",
                            },
                        },
                        valueExpr: "id",
                        displayExpr: "name",
                    },
                },
                {
                    dataField: "",
                    caption: "Opciones",
                    alignment: "center",
                    hidingPriority: 4,
                    width: '100',
                    minWidth: '100',
                    cellTemplate(container, options) {
                        const idCaracteristica = options.data.car_id;
                        let urlView = `/preview-formulario`;

                        let templateView = `<a href="${urlView}" title=""><i class="color-texto-cbre i-margin-cbre fas fa-eye"></i></a>`;
                        let templateDown = `<a href="" title="" data-id="${idCaracteristica}"><i class="color-texto-cbre i-margin-cbre fas fa-folder-download"></i></a>`;

                        const enlaceView = $('<a />').append(templateView).appendTo(container);
                        const enlaceDown = $('<a />').append(templateDown).appendTo(container);
                    },
                },
            ],
            paging: {
                pageSize: 10,
            },
            pager: {
                showNavigationButtons: true,
                visible: true,
                showPageSizeSelector: true,
                allowedPageSizes: [10, 15, 20],
            },
        }).dxDataGrid("instance");

        $('.btn-filtro').on('click', function(e) {
            e.preventDefault();
            dataGrid.refresh();
        });

        //  $('#fechaInicio, #fechaTermino, #estado').on('change', function(e) {
        //     dataGrid.refresh();
        //  });
    }


    function sendRequest(url, method, data) {
        let d = $.Deferred();
        method = method || "GET";
        $.ajax(url, {
            method: method || "GET",
            data: data, // Pasar los datos directamente sin serializarlos
            cache: false,
            xhrFields: {
                withCredentials: true,
            },
        })
            .done(function (result) {
                d.resolve(result);
            })
            .fail(function (xhr) {
                d.reject(
                    xhr.responseJSON ? xhr.responseJSON.Message : xhr.statusText
                );
            });

        return d.promise();
    }
});
