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
                    dataField: 'nombre',
                    caption: 'Nombre'
                },
                {
                    dataField: 'posicion',
                    caption: 'Posición'
                },
                {
                    dataField: 'estado',
                    caption: 'Estado',
                },
                {
                    dataField: '',
                    caption: 'Opciones',
                    alignment: 'center',
                    hidingPriority: 4,
                    cellTemplate(container, options) {
                        const idPerfil = options.data.per_id;
    
                        let urlModificar = `/administrador/perfiles/modificar-perfil/${idPerfil}`;
                        let templateModificar = `<a href="${urlModificar}" title="Modificar"><img src="/public/imagenes/i-edit.svg" class="svg-icon" alt=""></a>`;
                        let templateEliminar = `<a href="" title="Eliminar" id="eliminarPerfilEnlace" data-id="${idPerfil}"><img src="/public/imagenes/i-trash.svg" class="svg-icon" alt=""></a>`;
    
                        const enlaceModificar = $('<a />').append(templateModificar).appendTo(container);
                        const enlaceEliminar = $('<a />').append(templateEliminar).appendTo(container);
                        
                        enlaceEliminar.click(function (event) {
                            event.preventDefault();
    
                            url = `/administrador/perfiles/eliminar/${idPerfil}`;
    
                            fetch(url, {
                                method: 'GET',
                            })
                            .then(response => response.json())
                            .then(function (response) {
                                if ( response.status == 'OK' ) {
                                    cargarPerfiles();
                                    toastr.success(response.mensaje, 'Todo en orden')
                                } else {
                                    toastr.error(response.mensaje, 'Un momento');
                                }
                            })
                            .catch(mensajeError => {
                                toastr.error(mensajeError, '¡Rayos!');
                            });
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