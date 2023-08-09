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
                        return `${rowData.fun_nombre} ${rowData.fun_apellido}`;
                    }
                },
                {
                    dataField: "email",
                    caption: "Email",
                    filterOperations: ["contains"],
                    hidingPriority: 3, // prioridad para ocultar columna, 0 se oculta primero
                },
                {
                    dataField: "fun_cargo",
                    caption: "Cargo",
                    filterOperations: ["contains"],
                    hidingPriority: 3, // prioridad para ocultar columna, 0 se oculta primero
                    calculateCellValue: function(rowData) {
                        if(rowData.fun_cargo == 'Gerente'){
                            return 'Gerente de operaciones';
                        }else{
                            return rowData.fun_cargo
                        }
                    }
                },
                {
                    dataField: "edificio.edi_nombre",
                    caption: "Edificio",
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
                        const idFuncionario = options.data.fun_id;

                        let urlModificar = `/admin/funcionarios/${idFuncionario}/edit`;
                        let templateModificar = `<a href="${urlModificar}" title="Modificar"><i class='color-texto-cbre fas fa-pencil fa-fw'></i></a>`;
                        const enlaceModificar = $('<a />').append(templateModificar).appendTo(container);

                        const usuarioEsSuperAdmin = document.getElementById('dataGridFuncionarios').getAttribute('data-user-role');

                        if ( usuarioEsSuperAdmin ) {
                            let templateEliminar = `<a href="" title="Eliminar" id="eliminarFuncionarioEnlace" data-id="${idFuncionario}"><i class='fas fa-trash-can fa-fw pointer-none color-texto-cbre'></i></a>`;
                            const enlaceEliminar = $('<a />').append(templateEliminar).appendTo(container);

                            enlaceEliminar.click(function (event) {
                                event.preventDefault();

                                Swal.fire({
                                    title: '¿Deseas continuar?',
                                    text: "¡No podrás revertir esto!",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#005157',
                                    cancelButtonColor: '#343a40',
                                    confirmButtonText: 'Sí, eliminar',
                                    cancelButtonText: 'Cancelar',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        url = `/admin/funcionarios/${idFuncionario}`;
                                        const token = document.querySelector("input[name='_token']").value;

                                        fetch(url, {
                                            method: 'DELETE',
                                            headers: {
                                                'X-CSRF-TOKEN': token
                                            }
                                        })
                                        .then(response => response.json())
                                        .then(function (response) {
                                            if ( typeof response.status == 'undefined' ) {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Un momento...',
                                                    text: response.message
                                                })

                                                return;
                                            }

                                            if ( response.status == 'error' ) {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Un momento...',
                                                    text: response.message
                                                })

                                                return;
                                            }

                                            Swal.fire({
                                                position: "center",
                                                icon: "success",
                                                title: 'El funcionario ha sido eliminado.',
                                                showConfirmButton: false,
                                                timer: 1500,
                                            });

                                        })
                                        .then(() => {
                                            setTimeout(() => {
                                                cargarFuncionarios();
                                            }, 2000);
                                        })
                                        .catch(error => {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Un momento...',
                                                text: error.message
                                            });
                                        });
                                    }
                                })
                            });
                        }
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
