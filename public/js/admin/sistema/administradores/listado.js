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
                                document.location.href = "/admin/administradores";
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

    function turnOff(url) {
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
                        document.location.href = "/admin/administradores";
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

    function turnOn(url) {
        fetch(url, {
            method: "POST",
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
                        document.location.href = "/admin/administradores";
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
                        dataField: "user.email",
                        caption: "Email",
                        filterOperations: ["contains"],
                        hidingPriority: 3, // prioridad para ocultar columna, 0 se oculta primero
                    },
                    {
                        dataField: 'deleted_at',
                        caption: 'Estado',
                        filterOperations: ["contains"],
                        hidingPriority: 3, // prioridad para ocultar columna, 0 se oculta primero
                        alignment: 'center',
                        cellTemplate: function(container, options) {
                             let switchable;
                             const idAdministrador = options.data.adm_id;
                             let url_change_status_off = `/admin/administradores/${idAdministrador}`;
                             let url_change_status_on = `/admin/administradores/restore/${idAdministrador}`;

                           if(options.data.deleted_at === null){
                            switchable = "<a class='text-primary mr-2' href='#' onclick=\"turnOff('" + url_change_status_off + "')\"><i class='fas fa-toggle-on text-success'></i></a>";
                          }else{
                            switchable = "<a class='text-primary mr-2' href='#' onclick=\"turnOn('" + url_change_status_on + "')\"><i class='fas fa-toggle-off text-danger'></i></a>";
                          }
                           return $('<div>').append(switchable);
                        },
                     },
                    {
                        dataField: "",
                        caption: "Opciones",
                        alignment: "center",
                        hidingPriority: 4,
                        cellTemplate(container, options) {
                            const idAdministrador = options.data.adm_id;
                            let urlModificar = `/admin/administradores/${idAdministrador}/edit`;
                            //let urlEliminar = `/admin/administradores/${idAdministrador}`;
                            return $(
                                '<a href="' +
                                    urlModificar +
                                    '" class="edit"><i class="color-texto-cbre fas fa-pencil fa-fw"></i></a>'
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
