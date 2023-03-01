document.addEventListener('DOMContentLoaded', function () {
    cargarNoticias();

    function cargarNoticias() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
        });

        DevExpress.localization.locale(navigator.language);

        // Función para el origen de datos.
        const noticias = new DevExpress.data.CustomStore({
            load: function() {
                return sendRequest("/admin/noticias/get/list");
            }
        });

        $('#dataGridNoticias').dxDataGrid({
            dataSource: noticias,
            columns: [
                {
                    dataField: 'not_titulo',
                    caption: 'Título'
                },
                {
                    dataField: 'nombreEdificio',
                    caption: 'Edificio',
                },
                {
                    dataField: 'fechaChile',
                    caption: 'Fecha publicación',
                    width: '180',
                    minWidth: '180',
                    alignment: 'center',
                },
                {
                    dataField: 'hora',
                    caption: 'Hora',
                    width: '100',
                    minWidth: '100',
                    alignment: 'center',
                },
                {
                    dataField: '',
                    caption: 'Opciones',
                    alignment: 'center',
                    width: '90',
                    minWidth: '90',
                    hidingPriority: 4,
                    cellTemplate(container, options) {
                        const idNoticia = options.data.not_id;

                        let urlModificar = `/admin/noticias/${idNoticia}/edit`;
                        let templateModificar = `<a href="${urlModificar}" title="Modificar"><i class='color-texto-cbre fas fa-pencil fa-fw'></i></a>`;
                        let templateEliminar = `<a href="" title="Eliminar" id="eliminarNoticiaEnlace" data-id="${idNoticia}"><i class='fas fa-trash-can fa-fw pointer-none color-texto-cbre'></i></a>`;

                        const enlaceModificar = $('<a />').append(templateModificar).appendTo(container);
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
                                    url = `/admin/noticias/${idNoticia}`;
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
                                            'La noticia ha sido eliminada.',
                                            'success'
                                        )
                                    })
                                    .then(() => cargarNoticias())
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
