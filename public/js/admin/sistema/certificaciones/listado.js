document.addEventListener('DOMContentLoaded', function () {
    cargarCertificaciones();

    function cargarCertificaciones() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
        });
    
        DevExpress.localization.locale(navigator.language);
    
        // Función para el origen de datos.
        const certificaciones = new DevExpress.data.CustomStore({ 
            load: function() {
                return sendRequest("/admin/certificaciones/get/list");
            }
        });
    
        $('#dataGridCertificaciones').dxDataGrid({
            dataSource: certificaciones,
            columns: [
                {
                    dataField: 'cer_nombre',
                    caption: 'Nombre'
                },
                {
                    dataField: 'cer_posicion',
                    caption: 'Posición',
                    width: '80',
                    minWidth: '80',
                },
                {
                    dataField: 'estado',
                    caption: 'Estado',
                    width: '75',
                    minWidth: '75',
                },
                {
                    dataField: '',
                    caption: 'Opciones',
                    alignment: 'center',
                    width: '90',
                    minWidth: '90',
                    hidingPriority: 4,
                    cellTemplate(container, options) {
                        const idCertificacion = options.data.cer_id;
    
                        let urlModificar = `/admin/certificaciones/${idCertificacion}/edit`;
                        let templateModificar = `<a href="${urlModificar}" title="Modificar"><i class='color-texto-cbre fas fa-pencil fa-fw'></i></a>`;
                        let templateEliminar = `<a href="" title="Eliminar" id="eliminarPerfilEnlace" data-id="${idCertificacion}"><i class='fas fa-trash-can fa-fw pointer-none color-texto-cbre'></i></a>`;
    
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
                                    url = `/admin/certificaciones/${idCertificacion}`;
                                    const token = document.querySelector("input[name='_token']").value;

                                    fetch(url, {
                                        method: 'DELETE',
                                        headers: {
                                            'X-CSRF-TOKEN': token
                                        }
                                    })
                                    .then(response => response.json())
                                    .then(function (response) {
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
                                            'La certificación ha sido eliminada.',
                                            'success'
                                        )
                                    })
                                    .then(() => cargarCertificaciones())
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