document.addEventListener('DOMContentLoaded', function () {
    cargarComercios();

    function cargarComercios() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
        });

        DevExpress.localization.locale(navigator.language);

        // Función para el origen de datos.
        const comercios = new DevExpress.data.CustomStore({
            load: function() {
                return sendRequest("/admin/comercios/get/list");
            }
        });

        $('#dataGridComercios').dxDataGrid({
            dataSource: comercios,
            columns: [
                {
                    dataField: 'loc_nombre',
                    caption: 'Edificio'
                },
                {
                    dataField: 'nombreEdificio',
                    caption: 'Edificio'
                },
                {
                    dataField: '',
                    caption: 'Opciones',
                    alignment: 'center',
                    width: '90',
                    minWidth: '90',
                    hidingPriority: 4,
                    cellTemplate(container, options) {
                        const idComercio = options.data.loc_id;

                        let urlModificar = `/admin/comercios/${idComercio}/edit`;
                        let templateModificar = `<a href="${urlModificar}" title="Modificar"><i class='color-texto-cbre fas fa-pencil fa-fw'></i></a>`;
                        let templateEliminar = `<a href="" title="Eliminar" id="eliminarComercioEnlace" data-id="${idComercio}"><i class='fas fa-trash-can fa-fw pointer-none color-texto-cbre'></i></a>`;

                        const enlaceModificar = $('<a />').append(templateModificar).appendTo(container);
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
                                    url = `/admin/comercios/${idComercio}`;
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

                                        Swal.fire(
                                            '¡Listo!',
                                            'El comercio ha sido eliminado.',
                                            'success'
                                        )
                                    })
                                    .then(() => cargarComercios())
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
