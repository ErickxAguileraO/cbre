//document.addEventListener('DOMContentLoaded', function () {
// document.getElementById("guardar").addEventListener("click", function (event) {
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
                        document.location.href = "/admin/funcionarios";
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
                        document.location.href = "/admin/funcionarios";
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
        cargarFuncionarios();

        function cargarFuncionarios() {
            DevExpress.localization.locale(navigator.language);

            // Función para el origen de datos.
            const funcionarios = new DevExpress.data.CustomStore({
                load: function () {
                    return sendRequest("/admin/funcionarios/get/list");
                },
            });

            $("#dataGridFuncionarios").dxDataGrid({
                dataSource: funcionarios,
                columns: [
                    {
                        dataField: "Nombre",
                        caption: "Nombre",
                        filterOperations: ["contains"],
                        hidingPriority: 3, // prioridad para ocultar columna, 0 se oculta primero
                        calculateCellValue: function(rowData) {
                            return rowData.fun_nombre + " " + rowData.fun_apellido;
                        }
                    },
                    {
                        dataField: "user_trashed.email",
                        caption: "Email",
                        filterOperations: ["contains"],
                        hidingPriority: 3, // prioridad para ocultar columna, 0 se oculta primero
                    },
                    {
                        dataField: "fun_cargo",
                        caption: "Cargo",
                        filterOperations: ["contains"],
                        hidingPriority: 3, // prioridad para ocultar columna, 0 se oculta primero
                    },
                    {
                        dataField: 'deleted_at',
                        caption: 'Estado',
                        filterOperations: ["contains"],
                        hidingPriority: 2, // prioridad para ocultar columna, 0 se oculta primero
                        width: '100',
                        minWidth: '100',
                        alignment: 'center',
                        cellTemplate: function(container, options) {
                             let switchable;
                             const idFuncionario = options.data.fun_id;
                             let url_change_status_off = `/admin/funcionarios/${idFuncionario}`;
                             let url_change_status_on = `/admin/funcionarios/restore/${idFuncionario}`;

                           if(options.data.deleted_at === null){
                            switchable = "<a class='text-primary mr-2' href='#' onclick=\"turnOff('" + url_change_status_off + "')\"><i class='fas fa-toggle-on text-success'></i></a>";
                          }else{
                            switchable = "<a class='text-primary mr-2' href='#' onclick=\"turnOn('" + url_change_status_on + "')\"><i class='fas fa-toggle-off text-danger'></i></a>";
                          }
                           return $('<div>').append(switchable);
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
