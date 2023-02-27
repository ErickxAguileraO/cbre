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
                                document.location.href = "/admin/contactos";
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
        cargarContactos();

        function cargarContactos() {
            DevExpress.localization.locale(navigator.language);

            // Función para el origen de datos.
            const contactos = new DevExpress.data.CustomStore({
                load: function () {
                    return sendRequest("/admin/contactos/get/list");
                },
            });

            $("#dataGridContactos").dxDataGrid({
                dataSource: contactos,
                columns: [
                    {
                        dataField: "con_nombre_completo",
                        caption: "Nombre",
                        filterOperations: ["contains"],
                        alignment: "left",
                        hidingPriority: 3, // prioridad para ocultar columna, 0 se oculta primero
                    },
                    {
                        dataField: "con_email",
                        caption: "Email",
                        filterOperations: ["contains"],
                        alignment: "left",
                        hidingPriority: 3, // prioridad para ocultar columna, 0 se oculta primero
                    },
                    {
                        dataField: "con_telefono",
                        caption: "Teléfono",
                        filterOperations: ["contains"],
                        alignment: "left",
                        hidingPriority: 3, // prioridad para ocultar columna, 0 se oculta primero
                    },
                    {
                        dataField: "fechaChile",
                        caption: "Fecha",
                        width: '100',
                        minWidth: '100',
                        hidingPriority: 3, // prioridad para ocultar columna, 0 se oculta primero
                    },
                    {
                        dataField: "hora",
                        caption: "Hora",
                        width: '100',
                        minWidth: '100',
                        hidingPriority: 3, // prioridad para ocultar columna, 0 se oculta primero
                    },
                    {
                        dataField: "",
                        caption: "Opciones",
                        alignment: "center",
                        width: '100',
                        minWidth: '100',
                        hidingPriority: 4,
                        cellTemplate(container, options) {
                            console.log(options.data)
                            const idContacto = options.data.con_id;
                            let urlMostrar = `/admin/contactos/${idContacto}`;
                            let urlEliminar = `/admin/contactos/${idContacto}`;

                            return $(
                                '<a href="' +
                                    urlMostrar +
                                    '" class="edit"><i class="color-texto-cbre fa-solid fa-eye"></i></a>  <a class="eliminar_pedido" href="#" data-id="' +
                                    idContacto +
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
