
document.addEventListener("DOMContentLoaded", function () {
    cargarCaracteristicas();

    function cargarCaracteristicas() {
        DevExpress.localization.locale(navigator.language);

        // Función para el origen de datos.
        const caracteristicas = new DevExpress.data.CustomStore({
            load: function () {
                return sendRequest("");
            },
        });

        $("#dataGridAreaTecnica").dxDataGrid({
            dataSource: caracteristicas,
            columns: [
                {
                    dataField: "car_area",
                    caption: "Área",
                    filterOperations: ["contains"],
                    alignment: "left",
                    hidingPriority: 3, // prioridad para ocultar columna, 0 se oculta primero
                },
                {
                    dataField: "car_nombreFormulario",
                    caption: "Nombre formulario",
                    filterOperations: ["contains"],
                    alignment: "left",
                    hidingPriority: 3, // prioridad para ocultar columna, 0 se oculta primero
                    // width: '110',
                    // minWidth: '110',
                },
                {
                    dataField: "car_fechaEnvio",
                    caption: "Fecha de envío",
                    filterOperations: ["contains"],
                    alignment: "left",
                    hidingPriority: 3, // prioridad para ocultar columna, 0 se oculta primero
                    // width: '110',
                    // minWidth: '110',
                },
                {
                    dataField: "car_edificio",
                    caption: "Edificio",
                    filterOperations: ["contains"],
                    alignment: "left",
                    hidingPriority: 3, // prioridad para ocultar columna, 0 se oculta primero
                    // width: '110',
                    // minWidth: '110',
                },
                {
                    dataField: "car_archivos",
                    caption: "Archivos",
                    filterOperations: ["contains"],
                    alignment: "left",
                    hidingPriority: 3, // prioridad para ocultar columna, 0 se oculta primero
                    // width: '110',
                    // minWidth: '110',
                },
                {
                    dataField: "car_estado",
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
                                        name: "Inactivo",
                                    },
                                    {
                                        id: 1,
                                        name: "Activo",
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
                        let urlModificar = ``;
                        let urlEliminar = ``;

                        let templateView = `<a href="${urlModificar}" title=""><i class="color-texto-cbre i-margin-cbre fas fa-eye"></i></a>`;
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
                allowedPageSizes: [5, 10, 15, 20],
            },
        });
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
