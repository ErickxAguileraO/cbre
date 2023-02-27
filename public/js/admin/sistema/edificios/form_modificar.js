// Campos con CKEditor
let ckEditorDescripcion;
ClassicEditor.create(document.querySelector('#descripcionTextarea'), {
    removePlugins: ['MediaEmbed'],
    ckfinder: {
        uploadUrl: '/image-upload?_token='+$("input[name='_token']").val(),
    }
})
.then(editor => {
    ckEditorDescripcion = editor;
    ckEditorDescripcion.model.document.on( 'change:data', () => {
        document.getElementById('errorDescripcion').classList.add('invisible');
    } );
});

let ckEditorUbicacion;
ClassicEditor.create(document.querySelector('#ubicacionDescripcionTextarea'), {
    removePlugins: ['MediaEmbed'],
    ckfinder: {
        uploadUrl: '/image-upload?_token='+$("input[name='_token']").val(),
    }
})
.then(editor => {
    ckEditorUbicacion = editor;
    ckEditorUbicacion.model.document.on( 'change:data', () => {
        document.getElementById('errorUbicacionDescripcion').classList.add('invisible');
    } );
});

/** 
 * Quitar mensaje de validación de los campos
 */ 
document.getElementById('nombre').addEventListener('input', function () {
    document.getElementById('errorNombre').classList.add('invisible');
})

document.getElementById('descripcionTextarea').addEventListener('input', function () {
    document.getElementById('errorDescripcion').classList.add('invisible');
})

document.getElementById('direccion').addEventListener('input', function () {
    document.getElementById('errorDireccion').classList.add('invisible');
})

document.getElementById('imagenPrincipal').addEventListener('input', function () {
    document.getElementById('errorImagenPrincipal').classList.add('invisible');
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

document.getElementById('jefeNombre').addEventListener('input', function () {
    document.getElementById('errorJefeNombre').classList.add('invisible');
})

document.getElementById('jefeApellidos').addEventListener('input', function () {
    document.getElementById('errorJefeApellidos').classList.add('invisible');
})

document.getElementById('jefeEmail').addEventListener('input', function () {
    document.getElementById('errorJefeEmail').classList.add('invisible');
})

document.getElementById('jefeTelefono').addEventListener('input', function () {
    document.getElementById('errorJefeTelefono').classList.add('invisible');
})

document.getElementById('fotoJefe').addEventListener('input', function () {
    document.getElementById('errorFotoJefe').classList.add('invisible');
})

document.getElementById('asistenteNombre').addEventListener('input', function () {
    document.getElementById('errorAsistenteNombre').classList.add('invisible');
})

document.getElementById('asistenteApellidos').addEventListener('input', function () {
    document.getElementById('errorAsistenteApellidos').classList.add('invisible');
})

document.getElementById('asistenteEmail').addEventListener('input', function () {
    document.getElementById('errorAsistenteEmail').classList.add('invisible');
})

document.getElementById('asistenteTelefono').addEventListener('input', function () {
    document.getElementById('errorAsistenteTelefono').classList.add('invisible');
})

document.getElementById('fotoAsistente').addEventListener('input', function () {
    document.getElementById('errorFotoAsistente').classList.add('invisible');
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
    
    if ( typeof errores.descripcion !== 'undefined' ) {
        document.getElementById('errorDescripcion').innerHTML = errores.descripcion[0];
        document.getElementById('errorDescripcion').classList.remove('invisible');
    }

    if ( typeof errores.direccion !== 'undefined' ) {
        document.getElementById('errorDireccion').innerHTML = errores.direccion[0];
        document.getElementById('errorDireccion').classList.remove('invisible');
    }

    if ( typeof errores.imagenPrincipal !== 'undefined' ) {
        document.getElementById('errorImagenPrincipal').innerHTML = errores.imagenPrincipal[0];
        document.getElementById('errorImagenPrincipal').classList.remove('invisible');
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

    if ( typeof errores.ubicacionDescripcion !== 'undefined' ) {
        document.getElementById('errorUbicacionDescripcion').innerHTML = errores.ubicacionDescripcion[0];
        document.getElementById('errorUbicacionDescripcion').classList.remove('invisible');
    }

    if ( typeof errores.jefeNombre !== 'undefined' ) {
        document.getElementById('errorJefeNombre').innerHTML = errores.jefeNombre[0];
        document.getElementById('errorJefeNombre').classList.remove('invisible');
    }

    if ( typeof errores.jefeApellidos !== 'undefined' ) {
        document.getElementById('errorJefeApellidos').innerHTML = errores.jefeApellidos[0];
        document.getElementById('errorJefeApellidos').classList.remove('invisible');
    }

    if ( typeof errores.jefeEmail !== 'undefined' ) {
        document.getElementById('errorJefeEmail').innerHTML = errores.jefeEmail[0];
        document.getElementById('errorJefeEmail').classList.remove('invisible');
    }

    if ( typeof errores.jefeTelefono !== 'undefined' ) {
        document.getElementById('errorJefeTelefono').innerHTML = errores.jefeTelefono[0];
        document.getElementById('errorJefeTelefono').classList.remove('invisible');
    }

    if ( typeof errores.fotoJefe !== 'undefined' ) {
        document.getElementById('errorFotoJefe').innerHTML = errores.fotoJefe[0];
        document.getElementById('errorFotoJefe').classList.remove('invisible');
    }

    if ( typeof errores.asistenteNombre !== 'undefined' ) {
        document.getElementById('errorAsistenteNombre').innerHTML = errores.asistenteNombre[0];
        document.getElementById('errorAsistenteNombre').classList.remove('invisible');
    }

    if ( typeof errores.asistenteApellidos !== 'undefined' ) {
        document.getElementById('errorAsistenteApellidos').innerHTML = errores.asistenteApellidos[0];
        document.getElementById('errorAsistenteApellidos').classList.remove('invisible');
    }

    if ( typeof errores.asistenteEmail !== 'undefined' ) {
        document.getElementById('errorAsistenteEmail').innerHTML = errores.asistenteEmail[0];
        document.getElementById('errorAsistenteEmail').classList.remove('invisible');
    }

    if ( typeof errores.asistenteTelefono !== 'undefined' ) {
        document.getElementById('errorAsistenteTelefono').innerHTML = errores.asistenteTelefono[0];
        document.getElementById('errorAsistenteTelefono').classList.remove('invisible');
    }

    if ( typeof errores.fotoAsistente !== 'undefined' ) {
        document.getElementById('errorFotoAsistente').innerHTML = errores.fotoAsistente[0];
        document.getElementById('errorFotoAsistente').classList.remove('invisible');
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
document.getElementById('guardarButton').addEventListener('click', function (event) {
    event.preventDefault();
    
    const token = document.querySelector("input[name='_token']").value;
    const idEdificio = document.querySelector("input[name='idEdificio']").getAttribute('data-id-edificio');
    const formData = new FormData(document.forms.namedItem('formEdificio'));
    formData.append('descripcion', ckEditorDescripcion.getData());
    formData.append('ubicacionDescripcion', ckEditorUbicacion.getData());
    formData.append('latitud', map.center.lat());
    formData.append('longitud', map.center.lng());
    const url = `/admin/edificios/${idEdificio}`;
    
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
        if ( typeof response.errors !== 'undefined' ) {
            mostrarErroresValidacion(response.errors);

            return;
        }
        
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

        if ( response.status == 'success' ) {
            Swal.fire({
                icon: 'success',
                title: 'Edificio modificado',
                showConfirmButton: false,
                timer: 2000
            });

            setTimeout(function () {
                window.location.href = '/admin/edificios';
            }, 2000);
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Un momento...',
            text: error.message
        });
    });
});
