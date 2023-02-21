//document.addEventListener('DOMContentLoaded', function () {
// document.getElementById("guardar").addEventListener("click", function (event) {
function eliminar(url) {
    Swal.fire({
        title: "¿Estás seguro?",
        text: "¡No podrás revertir esto!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "¡Sí, Eliminalo!",
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(url, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN":
                        document.querySelector("[name=_token]").value,
                },
            })
                .then((response) => response.json())
                .then((response) => {
                    if (response.success) {
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: response.success,
                            showConfirmButton: false,
                            timer: 1500,
                        });
                        setTimeout(() => {
                            document.location.href = "/admin/caracteristicas";
                        }, 1500);
                    } else {
                        Swal.fire({
                            position: "center",
                            icon: "error",
                            title: response.error,
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    }
                })
                .catch((error) => {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: "¡Ha ocurrido un error!",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                });
        }
    });
}

document.addEventListener("DOMContentLoaded", function () {
    cargarCaracteristicas();

    function cargarCaracteristicas() {
        DevExpress.localization.locale(navigator.language);

        // Función para el origen de datos.
        const caracteristicas = new DevExpress.data.CustomStore({
            load: function () {
                return sendRequest("/admin/caracteristicas/get/list");
            },
        });

        $("#dataGridCaracteristicas").dxDataGrid({
            dataSource: caracteristicas,
            columns: [
                {
                    dataField: "car_nombre",
                    caption: "Nombre",
                    filterOperations: ["contains"],
                    alignment: "left",
                    hidingPriority: 3, // prioridad para ocultar columna, 0 se oculta primero
                },
                {
                    dataField: "car_posicion",
                    caption: "Posición",
                    filterOperations: ["contains"],
                    alignment: "left",
                    hidingPriority: 3, // prioridad para ocultar columna, 0 se oculta primero
                },
                {
                    dataField: "car_estado",
                    caption: "Estado",
                    allowEditing: false,
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
                    cellTemplate(container, options) {
                        const idCaracteristica = options.data.car_id;
                        let urlModificar = `/admin/caracteristicas/${idCaracteristica}/edit`;
                        let urlEliminar = `/admin/caracteristicas/${idCaracteristica}`;

                        return $(
                            '<a href="' +
                                urlModificar +
                                '" class="edit"><i class="color-texto-cbre fas fa-pencil fa-fw"></i></a>  <a class="eliminar_pedido" href="#" data-id="' +
                                idCaracteristica +
                                '" onclick=eliminar("' +
                                urlEliminar +
                                '")><i class="fas fa-trash-can fa-fw pointer-none color-texto-cbre"></i></a>'
                        );
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
