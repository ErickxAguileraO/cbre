
document.addEventListener("DOMContentLoaded", function () {
    cargarSubmercados();

    function cargarSubmercados() {
        DevExpress.localization.locale(navigator.language);

        // Función para el origen de datos.
        const submercados = new DevExpress.data.CustomStore({
            load: function () {
                return sendRequest("/admin/submercados/get/list");
            },
        });

        $("#dataGridSubmercados").dxDataGrid({
            dataSource: submercados,
            columns: [
                {
                    dataField: "sub_nombre",
                    caption: "Nombre",
                    hidingPriority: 2,
                },
                {
                    dataField: "comuna.region.reg_nombre",
                    caption: "Región",
                    hidingPriority: 1,
                },
                {
                    dataField: "comuna.com_nombre",
                    caption: "Comuna",
                    hidingPriority: 3,
                },
                {
                    dataField: 'sub_estado',
                    caption: 'Estado',
                    allowEditing: false,
                    hidingPriority: 3,
                    width: '100',
                    minWidth: '100',
                    alignment: "center",
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
                    dataField: "",
                    caption: "Opciones",
                    alignment: "center",
                    hidingPriority: 4,
                    width: '100',
                    minWidth: '100',
                    cellTemplate(container, options) {
                        const idSubMercado = options.data.sub_id;
                        let urlModificar = `/admin/submercados/${idSubMercado}/edit`;
                        let urlEliminar = `/admin/submercados/${idSubMercado}`;

                        let templateModificar = `<a href="${urlModificar}" title="Modificar"><i class='color-texto-cbre fas fa-pencil fa-fw'></i></a>`;
                        let templateEliminar = `<a href="" title="Eliminar" data-id="${idSubMercado}"><i class='fas fa-trash-can fa-fw pointer-none color-texto-cbre'></i></a>`;

                        const enlaceModificar = $('<a />').append(templateModificar).appendTo(container);
                        const enlaceEliminar = $('<a />').append(templateEliminar).appendTo(container);

                    enlaceEliminar.click(function (event) {
                        event.preventDefault();
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
                                fetch(urlEliminar, {
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
                                                cargarSubmercados();
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
                    });
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
