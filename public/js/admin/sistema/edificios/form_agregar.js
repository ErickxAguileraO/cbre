// Campos con CKEditor
/* let ckEditorDescripcion;
ClassicEditor.create(document.querySelector('#descripcionTextarea'), configuracionCkeditor)
.then(editor => {
    ckEditorDescripcion = editor;
    ckEditorDescripcion.model.document.on( 'change:data', () => {
        document.getElementById('errorDescripcion').classList.add('invisible');
    } );
}); */

/* let ckEditorUbicacion;
ClassicEditor.create(document.querySelector('#ubicacionDescripcionTextarea'), configuracionCkeditor)
.then(editor => {
    ckEditorUbicacion = editor;
    ckEditorUbicacion.model.document.on( 'change:data', () => {
        document.getElementById('errorUbicacionDescripcion').classList.add('invisible');
    } );
}); */

/**
 * Quitar mensaje de validación de los campos
 */
document.getElementById('nombre').addEventListener('input', function () {
    document.getElementById('errorNombre').classList.add('invisible');
})

document.getElementById('descripcionTextarea').addEventListener('input', function () {
    document.getElementById('errorDescripcion').classList.add('invisible');
})

document.getElementById('imagenPrincipal').addEventListener('input', function () {
    document.getElementById('errorImagenPrincipal').classList.add('invisible');
})

/* document.getElementById('imagenListado').addEventListener('input', function () {
    document.getElementById('errorImagenListado').classList.add('invisible');
}) */

document.getElementById('inputFileListado').addEventListener('input', function () {
    document.getElementById('errorImagenListado').classList.add('invisible');
})

document.getElementById('inputFileGaleria').addEventListener('input', function () {
    document.getElementById('errorImagenesGaleria').classList.add('invisible');
})

document.getElementById('video').addEventListener('input', function () {
    document.getElementById('errorVideo').classList.add('invisible');
})

$('#submercado').change(function () {
    document.getElementById('errorSubmercado').classList.add('invisible');;
});

document.getElementById('ubicacionTitulo').addEventListener('input', function () {
    document.getElementById('errorUbicacionTitulo').classList.add('invisible');
})

document.getElementById('ubicacionDescripcionTextarea').addEventListener('input', function () {
    document.getElementById('errorUbicacionDescripcion').classList.add('invisible');
})

// Quitar mensaje de select2
$('#certificaciones').change(function () {
    document.getElementById('errorCertificaciones').classList.add('invisible');;
});

$('#caracteristicas').change(function () {
    document.getElementById('errorCaracteristicas').classList.add('invisible');;
});

document.getElementById('subdominio').addEventListener('input', function () {
    document.getElementById('errorSubdominio').classList.add('invisible');
})

function mostrarErroresValidacion(errores) {
    if ( typeof errores.nombre !== 'undefined' ) {
        document.getElementById('errorNombre').innerHTML = errores.nombre[0];
        document.getElementById('errorNombre').classList.remove('invisible');
    }

    if ( typeof errores.descripcionTextarea !== 'undefined' ) {
        document.getElementById('errorDescripcion').innerHTML = errores.descripcionTextarea[0];
        document.getElementById('errorDescripcion').classList.remove('invisible');
    }

    if ( typeof errores.imagenPrincipal !== 'undefined' ) {
        document.getElementById('errorImagenPrincipal').innerHTML = errores.imagenPrincipal[0];
        document.getElementById('errorImagenPrincipal').classList.remove('invisible');
    }

/*     if ( typeof errores.imagenListado !== 'undefined' ) {
        document.getElementById('errorImagenListado').innerHTML = errores.imagenListado[0];
        document.getElementById('errorImagenListado').classList.remove('invisible');
    } */

    if ( typeof errores.imagenListado !== 'undefined' ) {
        document.getElementById('errorImagenListado').innerHTML = errores.imagenListado[0];
        document.getElementById('errorImagenListado').classList.remove('invisible');
    }

    if ( typeof errores.imagenesGaleria !== 'undefined' ) {
        document.getElementById('errorImagenesGaleria').innerHTML = errores.imagenesGaleria[0];
        document.getElementById('errorImagenesGaleria').classList.remove('invisible');
    }

    if ( typeof errores.video !== 'undefined' ) {
        document.getElementById('errorVideo').innerHTML = errores.video[0];
        document.getElementById('errorVideo').classList.remove('invisible');
    }

    if ( typeof errores.submercado !== 'undefined' ) {
        document.getElementById('errorSubmercado').innerHTML = errores.submercado[0];
        document.getElementById('errorSubmercado').classList.remove('invisible');
    }

    if ( typeof errores.ubicacionTitulo !== 'undefined' ) {
        document.getElementById('errorUbicacionTitulo').innerHTML = errores.ubicacionTitulo[0];
        document.getElementById('errorUbicacionTitulo').classList.remove('invisible');
    }

    if ( typeof errores.ubicacionDescripcionTextarea !== 'undefined' ) {
        document.getElementById('errorUbicacionDescripcion').innerHTML = errores.ubicacionDescripcionTextarea[0];
        document.getElementById('errorUbicacionDescripcion').classList.remove('invisible');
    }

    if ( typeof errores.certificaciones !== 'undefined' ) {
        document.getElementById('errorCertificaciones').innerHTML = errores.certificaciones[0];
        document.getElementById('errorCertificaciones').classList.remove('invisible');
    }

    if ( typeof errores.caracteristicas !== 'undefined' ) {
        document.getElementById('errorCaracteristicas').innerHTML = errores.caracteristicas[0];
        document.getElementById('errorCaracteristicas').classList.remove('invisible');
    }

    if ( typeof errores.subdominio !== 'undefined' ) {
        document.getElementById('errorSubdominio').innerHTML = errores.subdominio[0];
        document.getElementById('errorSubdominio').classList.remove('invisible');
    }
}

/**
 * Configuración de los elementos de tipo inputfile
 */
const inputFiles = document.querySelectorAll('.input-file');

Array.from(inputFiles).forEach(function (inputFile) {
    inputFile.addEventListener('change', function () {
        const spanArchivoSeleccionado = this.parentElement.nextElementSibling.firstElementChild;

        switch (true) {
            case inputFile.files.length == 0:
                spanArchivoSeleccionado.innerHTML = 'Ningún archivo seleccionado';
                break;

            case inputFile.files.length == 1:
                spanArchivoSeleccionado.innerHTML = inputFile.files[0].name;
                break;

            case inputFile.files.length > 1:
                spanArchivoSeleccionado.innerHTML = `${inputFile.files.length} archivos seleccionados`;
                break;

            default:
                break;
        }
    });
});

/**
 * Envío del formulario
 */
document.getElementById('guardar').addEventListener('click', function (event) {
    event.preventDefault();

    const token = document.querySelector("input[name='_token']").value;
    const formData = new FormData(document.forms.namedItem('formEdificio'));
    //formData.append('descripcion', ckEditorDescripcion.getData());
    //formData.append('ubicacionDescripcion', ckEditorUbicacion.getData());
    formData.append('latitud', map.center.lat());
    formData.append('longitud', map.center.lng());
    formData.append('direccion', direccion);
    const url = '/admin/edificios';

    isLoadingSpinner("guardar", true);

    fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(response => response.json())
    .then(function (response) {

        isLoadingSpinner("guardar", true);

        setTimeout(() => {
            if ( typeof response.errors !== 'undefined' ) {
                isLoadingSpinner("guardar", false);
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "Debes completar todos los campos",
                    showConfirmButton: false,
                    timer: 1500,
                });
                mostrarErroresValidacion(response.errors);

                return;
            }

            if ( typeof response.status == 'undefined' ) {
                isLoadingSpinner("guardar", false);
                Swal.fire({
                    icon: 'error',
                    title: 'Un momento...',
                    text: response.message
                })

                return;
            }

            if ( response.status == 'error' ) {
                isLoadingSpinner("guardar", false);
                Swal.fire({
                    icon: 'error',
                    title: 'Un momento...',
                    text: response.message
                })

                return;
            }

            if ( response.status == 'success' ) {
                isLoadingSpinner("guardar", 'done');
                Swal.fire({
                    icon: 'success',
                    title: 'Edificio agregado',
                    showConfirmButton: false,
                    timer: 2000
                });

                setTimeout(function () {
                    window.location.href = '/admin/edificios';
                }, 2000);
            }

        }, 1000);
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Un momento...',
            text: error.message
        });
    });
});
