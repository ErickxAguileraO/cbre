
document.addEventListener("DOMContentLoaded", function () {
    cargarExportar();

    function cargarExportar() {
        DevExpress.localization.locale(navigator.language);

        // Función para el origen de datos.
        const exportarData = new DevExpress.data.CustomStore({
            load: function (loadOptions) {
                const params = {
                    fechaInicio: document.querySelector('#fechaInicio').value,
                    fechaTermino: document.querySelector('#fechaTermino').value,
                    creado_por: document.querySelector('#creado_por') ? document.querySelector('#creado_por').value : null,
                };

                return sendRequest("/admin/exportar/get/list", "GET", params);
            },
        });

        const dataGrid = $("#dataGridExportar").dxDataGrid({
            dataSource: exportarData,
            columnChooser: {
                enabled: true,
                mode: 'select',
            },
            // Resto del código del data grid...
            columns: [
                {
                    dataField: "rol_funcionario",
                    caption: "Área",
                    filterOperations: ["contains"],
                    hidingPriority: 3, // prioridad para ocultar columna, 0 se oculta primero
                    width: 200,
                    alignment: "center",
                },
                {
                    dataField: "form_nombre",
                    caption: "Nombre Formulario",
                    filterOperations: ["contains"],
                    alignment: "left",
                    hidingPriority: 3, // prioridad para ocultar columna, 0 se oculta primero
                    // width: '110',
                    // minWidth: '110',
                },
                {
                    dataField: "updated_at_formatted",
                    caption: "Fecha de envío",
                    filterOperations: ["contains"],
                    hidingPriority: 3, // prioridad para ocultar columna, 0 se oculta primero
                    width: 200,
                    alignment: "center",
                    // minWidth: '110',
                },
                {
                    dataField: "cantidad_edificios",
                    caption: "Edificio",
                    filterOperations: ["contains"],
                    alignment: "center",
                    hidingPriority: 3,
                    width: 100,
                    cellTemplate(container, options) {
                        const cantidadEdificios = options.value; // Obtenemos el valor real desde la columna "cantidad_edificios"
                        const edificios = options.data.edificio; // Obtenemos el listado de nombres de edificios
                        const formularioNombre = options.data.form_nombre; // Obtenemos el nombre del formulario

                        const $link = $("<a>")
                            .text(cantidadEdificios)
                            .addClass("contador-archivos cursor-pointer")
                            .on("click", function () {
                                // Mostrar el nombre del formulario en el modal
                                $("#formularioNombre").text(formularioNombre);

                                // Vaciar la lista de edificios existente en el modal
                                $("#edificiosList").empty();

                                // Agregar los edificios al modal si hay edificios asociados
                                if (edificios.length > 0) {
                                    edificios.forEach((edificio) => {
                                        $("<div>")
                                            .text(edificio)
                                            .addClass("archivo-subido-n")
                                            .appendTo("#edificiosList");
                                    });
                                } else {
                                    // Mostrar mensaje si no hay edificios asociados
                                    $("<div>")
                                        .text("No hay edificios asociados a este formulario.")
                                        .addClass("archivo-subido-n")
                                        .appendTo("#edificiosList");
                                }

                                // Mostrar el modal
                                $(".contenedor__modalFormulario").css("display", "flex");
                            });

                        $link.appendTo(container);
                    },
                },
                {
                    dataField: "",
                    caption: "Exportar",
                    alignment: "center",
                    hidingPriority: 4,
                    width: '100',
                    minWidth: '100',
                    cellTemplate(container, options) {
                        let formId = options.data.form_id;
                        let urlExp = `/admin/exportar/download-excel/${formId}`;
                        console.log(options.data)
                        let templateExp = `<a href="${urlExp}" title=""><i class="color-texto-cbre i-margin-cbre fas fa-file-excel"></i></a>`;
                        const enlaceExp = $('<a />').append(templateExp).appendTo(container);
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
