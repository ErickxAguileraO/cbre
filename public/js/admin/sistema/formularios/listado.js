
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
                    dataField: "estado",
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
                        const idFormulario = options.data.form_id;
                        const estado = options.data.estado;
                        const idEdificio = options.data.edificio_id;
                        console.log(options.data);
                        let urlResponder = `/admin/formulario-jop/${idFormulario}`;
                        let urlView = `/admin/formulario-area-tecnica/show/${idFormulario}/${idEdificio}`;

                        let templateResponder = `<a href="${urlResponder}" class="btn btn-success text-white">Responder</a>`;
                        let templateView = ''; // Inicialmente oculto el botón adicional
                        if (estado === 2) { // Estado "Enviado"
                            templateResponder = ''; // Oculta el botón "Responder"
                            templateView = `<a href="${urlView}" title=""><i class="color-texto-cbre i-margin-cbre fas fa-eye"></i></a>`; // Muestra el botón adicional
                          }
                        const enlaceView = $('<a />').append(templateView).appendTo(container);
                        const enlaceResponder = $('<a />').append(templateResponder).appendTo(container);
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
