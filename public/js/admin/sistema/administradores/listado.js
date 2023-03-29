
    document.addEventListener("DOMContentLoaded", function () {
        cargarAdministradores();

        function cargarAdministradores() {
            DevExpress.localization.locale(navigator.language);

            // Función para el origen de datos.
            const administradores = new DevExpress.data.CustomStore({
                load: function () {
                    return sendRequest("/admin/administradores/get/list");
                },
            });

            $("#dataGridAdministradores").dxDataGrid({
                dataSource: administradores,
                columns: [
                    {
                        dataField: "Nombre",
                        caption: "Nombre",
                        filterOperations: ["contains"],
                        hidingPriority: 3, // prioridad para ocultar columna, 0 se oculta primero
                        calculateCellValue: function(rowData) {
                            return rowData.adm_nombre + " " + rowData.adm_apellido;
                        }
                    },
                    {
                        dataField: "user_trashed.email",
                        caption: "Email",
                        filterOperations: ["contains"],
                        hidingPriority: 3, // prioridad para ocultar columna, 0 se oculta primero
                    },
                    {
                        dataField: 'deleted_at',
                        caption: 'Estado',
                        filterOperations: ["contains"],
                        hidingPriority: 3, // prioridad para ocultar columna, 0 se oculta primero
                        width: '100',
                        minWidth: '100',
                        alignment: 'center',
                        cellTemplate: function(container, options) {
                            const idAdministrador = options.data.adm_id;
                             let switchableTemplate;
                             let url_change_status;
                             let method;

                        if(options.data.deleted_at === null){
                            switchableTemplate = `<a href="" title="Eliminar" data-id="${idAdministrador}"><i class='fas fa-toggle-on text-success'></i></a>`;
                            url_change_status = `/admin/administradores/${idAdministrador}`;
                            method = "DELETE";
                          }else{
                            switchableTemplate = `<a href="" title="Eliminar" data-id="${idAdministrador}"><i class='fas fa-toggle-off text-danger'></i></a>`;
                            url_change_status = `/admin/administradores/restore/${idAdministrador}`;
                            method = "POST";
                        }

                          const enlaceChangeStatus = $('<a />').append(switchableTemplate).appendTo(container);

                          enlaceChangeStatus.click(function (event) {
                            event.preventDefault();
                            if(method === "DELETE"){
                                Swal.fire({
                                    title: "¿Estás seguro?",
                                    text: "¡Un usuario deshabilitado no podrá acceder al sistema!",
                                    icon: "warning",
                                    showCancelButton: true,
                                    confirmButtonColor: "#005157",
                                    cancelButtonColor: "#343a40",
                                    confirmButtonText: "¡Sí, deshabilítalo!",
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        fetch(url_change_status, {
                                            method: method,
                                            headers: {
                                                "X-CSRF-TOKEN":
                                                    document.querySelector("[name=_token]").value,
                                            },
                                        })
                                            .then((response) => response.json())
                                            .then((response) => {
                                                if (response.success) {
                                                    cargarAdministradores();
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
                            }else{
                                fetch(url_change_status, {
                                    method: method,
                                    headers: {
                                        "X-CSRF-TOKEN":
                                            document.querySelector("[name=_token]").value,
                                    },
                                })
                                    .then((response) => response.json())
                                    .then((response) => {
                                        if (response.success) {
                                            cargarAdministradores();
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
                            const idAdministrador = options.data.adm_id;
                            let urlModificar = `/admin/administradores/${idAdministrador}/edit`;
                            let urlForceEliminar = `/admin/administradores/force-destroy/${idAdministrador}`;

                            let templateModificar = `<a href="${urlModificar}" title="Modificar"><i class='color-texto-cbre fas fa-pencil fa-fw'></i></a>`;
                            let templateEliminar = `<a href="" title="Eliminar" data-id="${idAdministrador}"><i class='fas fa-trash-can fa-fw pointer-none color-texto-cbre'></i></a>`;

                            const enlaceModificar = $('<a />').append(templateModificar).appendTo(container);
                            const enlaceForceEliminar = $('<a />').append(templateEliminar).appendTo(container);

                            enlaceForceEliminar.click(function (event) {
                                event.preventDefault();
                                Swal.fire({
                                    title: "¿Estás seguro?",
                                    text: "¡No podrás revertir esto!",
                                    icon: "warning",
                                    showCancelButton: true,
                                    confirmButtonColor: "#005157",
                                    cancelButtonColor: "#343a40",
                                    confirmButtonText: "¡Sí, Eliminalo!",
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        fetch(urlForceEliminar, {
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
                                                        cargarAdministradores()
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
