
document.addEventListener("DOMContentLoaded", function () {
    cargarCaracteristicas();

    function cargarCaracteristicas() {
        DevExpress.localization.locale(navigator.language);

        // Función para el origen de datos.
        const formulario = new DevExpress.data.CustomStore({
            load: function (loadOptions) {
                const params = {
                    fechaInicio: document.querySelector('#fechaInicio').value,
                    fechaTermino: document.querySelector('#fechaTermino').value,
                    estado: document.querySelector('#estado').value,
                };

                return sendRequest("/admin/formulario-jop/get/list", "GET", params);
            },
        });

        const dataGrid = $("#dataGridFormularios").dxDataGrid({
            dataSource: formulario,
            // Resto del código del data grid...
            columns: [
                {
                    dataField: "form_nombre",
                    caption: "Nombre formulario",
                    filterOperations: ["contains"],
                    alignment: "left",
                    hidingPriority: 3, // prioridad para ocultar columna, 0 se oculta primero
                },
                {
                    dataField: "rol_funcionario",
                    caption: "Enviado por",
                    filterOperations: ["contains"],
                    alignment: "left",
                    hidingPriority: 3, // prioridad para ocultar columna, 0 se oculta primero
                    // width: '110',
                    // minWidth: '110',
                },
                {
                    dataField: "fecha",
                    caption: "Fecha recepción",
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
                                        id: 1,
                                        name: "Pendiente",
                                    },
                                    {
                                        id: 2,
                                        name: "Enviado",
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
                    caption: "",
                    alignment: "center",
                    hidingPriority: 4,
                    width: '200',
                    minWidth: '200',
                    cellTemplate(container, options) {
                        const idCaracteristica = options.data.car_id;
                        let urlResponder = `/responder-formulario`;

                        let templateResponder = `<a href="${urlResponder}" class="btn btn-success text-white">Responder</a>`;

                        const enlaceView = $('<a />').append(templateResponder).appendTo(container);
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
                allowedPageSizes: [5, 10, 15, 20],
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
            data: data,
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
