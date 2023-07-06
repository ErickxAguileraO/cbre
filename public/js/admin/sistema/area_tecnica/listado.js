
document.addEventListener("DOMContentLoaded", function () {
    cargarFormulario();

    function cargarFormulario() {
        DevExpress.localization.locale(navigator.language);

        // Función para el origen de datos.
        const formulario = new DevExpress.data.CustomStore({
            load: function () {
                return sendRequest("/admin/formulario-area-tecnica/get/list");
            },
        });

        $("#dataGridAreaTecnica").dxDataGrid({
            dataSource: formulario,
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
        });


        $(".btn-filtro").click(function () {
            // Obtener valores de los campos de búsqueda
            // const edificio = $("#edificio").val();
            const fechaInicio = $("#fechaInicio").val();
            const fechaTermino = $("#fechaTermino").val();
            const estado = $("#estado").val();
            // const creadoPor = $("#creadoPor").val();

            // Construir parámetros de búsqueda
            const params = {
                // edificio: edificio,
                fechaInicio: fechaInicio,
                fechaTermino: fechaTermino,
                estado: estado,
                // creadoPor: creadoPor,
            };

            // Llamar a la función sendRequest() con los parámetros de búsqueda
            sendRequest("{{ route('formulario-area-tecnica.list') }}", "GET", params)
                .then(function (result) {
                    // Actualizar la tabla DevExtreme con los datos filtrados
                    $("#dataGridAreaTecnica").dxDataGrid("instance").option("dataSource", result);
                })
                .catch(function (error) {
                    console.error("Error al obtener los datos filtrados:", error);
                });
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
