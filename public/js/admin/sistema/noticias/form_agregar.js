let ckEditor;
ClassicEditor.create(document.querySelector('#cuerpoTextarea'), {
    removePlugins: ['MediaEmbed'],
    ckfinder: {
        uploadUrl: '/image-upload?_token='+$("input[name='_token']").val(),
    },
})
.then(editor => {
    ckEditor = editor;
    ckEditor.model.document.on( 'change:data', () => {
        document.getElementById('errorCuerpo').classList.add('invisible');
    } );
});

document.getElementById('titulo').addEventListener('input', function () {
    document.getElementById('errorTitulo').classList.add('invisible');
})

document.getElementById('fecha').addEventListener('input', function () {
    document.getElementById('errorFecha').classList.add('invisible');
})

document.getElementById('inputFileGaleria').addEventListener('input', function () {
    document.getElementById('errorImagenesGaleria').classList.add('invisible');
})

document.getElementById('cuerpoTextarea').addEventListener('input', function () {
    document.getElementById('errorCuerpo').classList.add('invisible');
})

document.getElementById('edificio').addEventListener('input', function () {
    document.getElementById('errorEdificio').classList.add('invisible');
})

function mostrarErroresValidacion(errores) {
    if ( typeof errores.titulo !== 'undefined' ) {
        document.getElementById('errorTitulo').innerHTML = errores.titulo[0];
        document.getElementById('errorTitulo').classList.remove('invisible');
    }

    if ( typeof errores.fecha !== 'undefined' ) {
        document.getElementById('errorFecha').innerHTML = errores.fecha[0];
        document.getElementById('errorFecha').classList.remove('invisible');
    }

    if ( typeof errores.cuerpo !== 'undefined' ) {
        document.getElementById('errorCuerpo').innerHTML = errores.cuerpo[0];
        document.getElementById('errorCuerpo').classList.remove('invisible');
    }

    if ( typeof errores.edificio !== 'undefined' ) {
        document.getElementById('errorEdificio').innerHTML = errores.edificio[0];
        document.getElementById('errorEdificio').classList.remove('invisible');
    }

    if ( typeof errores.imagenesGaleria !== 'undefined' ) {
        document.getElementById('errorImagenesGaleria').innerHTML = errores.imagenesGaleria[0];
        document.getElementById('errorImagenesGaleria').classList.remove('invisible');
    }
}

const inputFiles = document.querySelectorAll('.input-file');

Array.from(inputFiles).forEach(function (inputFile) {
    inputFile.addEventListener('change', function () {
        const spanArchivoSeleccionado = document.querySelector('.archivo-seleccionado > span');
        spanArchivoSeleccionado.innerHTML = inputFile.files[0].name;
    });
});

document.getElementById('guardarButton').addEventListener('click', function (event) {
    event.preventDefault();

    const token = document.querySelector("input[name='_token']").value;
    const formData = new FormData(document.forms.namedItem('formNoticia'));
    formData.append('cuerpo', ckEditor.getData());
    const url = '/admin/noticias';

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
                title: 'Noticia agregada',
                showConfirmButton: false,
                timer: 2000
            });

            setTimeout(function () {
                window.location.href = '/admin/noticias';
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