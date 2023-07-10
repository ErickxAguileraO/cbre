
document.addEventListener("DOMContentLoaded", function () {
    cargarCaracteristicas();

    function cargarCaracteristicas() {
        DevExpress.localization.locale(navigator.language);

        // Función para el origen de datos.
        const mantenciones = new DevExpress.data.CustomStore({
            load: function (loadOptions) {
                const params = {
                    fechaInicio: document.querySelector('#fechaInicio').value,
                    fechaTermino: document.querySelector('#fechaTermino').value,
                    especialidad: document.querySelector('#especialidad').value,
                };

                return sendRequest("/admin/mantenciones-jop/get/list", "GET", params);
            },
        });

        const dataGrid = $("#dataGridMantenciones").dxDataGrid({
            dataSource: mantenciones,
            // Resto del código del data grid...
            columns: [
                {
                    dataField: "especialidades",
                    caption: "Especialidad",
                    filterOperations: ["contains"],
                    alignment: "left",
                    hidingPriority: 3, // prioridad para ocultar columna, 0 se oculta primero
                },
                {
                    dataField: "fecha",
                    caption: "Fecha mantención",
                    filterOperations: ["contains"],
                    alignment: "left",
                    hidingPriority: 3, // prioridad para ocultar columna, 0 se oculta primero
                    // width: '110',
                    // minWidth: '110',
                },
                {
                    dataField: "",
                    caption: "",
                    alignment: "center",
                    hidingPriority: 4,
                    width: '100',
                    minWidth: '100',
                    cellTemplate(container, options) {
                        const idCaracteristica = options.data.car_id;
                        let urlView = `/ver-mantencion`;

                        let templateView = `<a href="${urlView}" title=""><i class="color-texto-cbre i-margin-cbre fas fa-eye"></i></a>`;

                        const enlaceView = $('<a />').append(templateView).appendTo(container);
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
