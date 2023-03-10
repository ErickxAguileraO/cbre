document.addEventListener('DOMContentLoaded', function () {
    cargarEdificios();

    function cargarEdificios() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
        });

        DevExpress.localization.locale(navigator.language);

        // Función para el origen de datos.
        const edificios = new DevExpress.data.CustomStore({
            load: function() {
                return sendRequest("/admin/edificios/get/list");
            }
        });

        $('#dataGridEdificios').dxDataGrid({
            dataSource: edificios,
            columns: [
                {
                    dataField: 'edi_nombre',
                    caption: 'Nombre'
                },
                {
                    dataField: 'edi_direccion',
                    caption: 'Dirección'
                },
                {
                    dataField: 'edi_subdominio',
                    caption: 'Subdominio',
                    width: '140',
                    minWidth: '140',
                },
                {
                    dataField: '',
                    caption: 'Opciones',
                    alignment: 'center',
                    width: '90',
                    minWidth: '90',
                    hidingPriority: 4,
                    cellTemplate(container, options) {
                        const idEdificio = options.data.edi_id;

                        let urlModificar = `/admin/edificios/${idEdificio}/edit`;
                        let templateModificar = `<a href="${urlModificar}" title="Modificar"><i class='color-texto-cbre fas fa-pencil fa-fw'></i></a>`;
                        const enlaceModificar = $('<a />').append(templateModificar).appendTo(container);

                        const usuarioEsSuperAdmin = document.getElementById('dataGridEdificios').getAttribute('data-user-role');

                        if ( usuarioEsSuperAdmin ) {
                            let templateEliminar = `<a href="" title="Eliminar" id="eliminarEdificioEnlace" data-id="${idEdificio}"><i class='fas fa-trash-can fa-fw pointer-none color-texto-cbre'></i></a>`;
                            const enlaceEliminar = $('<a />').append(templateEliminar).appendTo(container);

                            enlaceEliminar.click(function (event) {
                                event.preventDefault();

                                Swal.fire({
                                    title: '¿Deseas continuar?',
                                    text: "¡No podrás revertir esto!",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Sí, eliminar',
                                    cancelButtonText: 'Cancelar',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        url = `/admin/edificios/${idEdificio}`;
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
                                                title: 'El edificio ha sido eliminado.',
                                                showConfirmButton: false,
                                                timer: 1500,
                                            });

                                        })
                                        .then(() => {
                                            setTimeout(() => {
                                                cargarEdificios();
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
                    }
                }
            ],
            paging: {
                pageSize: 10
            },
            pager: {
                showNavigationButtons: true,
                visible: true,
                showPageSizeSelector: true,
                allowedPageSizes: [5, 10, 15, 20]
            }
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
                withCredentials: true
            }
        }).done(function(result) {
            d.resolve(result);
        }).fail(function(xhr) {
            d.reject(xhr.responseJSON ? xhr.responseJSON.Message : xhr.statusText);
        });

        return d.promise();
    }
});
