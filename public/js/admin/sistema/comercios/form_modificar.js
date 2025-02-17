
document.getElementById('nombre').addEventListener('input', function () {
    document.getElementById('errorNombre').classList.add('invisible');
})

document.getElementById('descripcionTextarea').addEventListener('input', function () {
    document.getElementById('errorDescripcion').classList.add('invisible');
})

document.getElementById('edificio').addEventListener('input', function () {
    document.getElementById('errorEdificio').classList.add('invisible');
})

$('#edificio').change(function () {
    document.getElementById('errorEdificio').classList.add('invisible');;
});

function mostrarErroresValidacion(errores) {
    if ( typeof errores.nombre !== 'undefined' ) {
        document.getElementById('errorNombre').innerHTML = errores.nombre[0];
        document.getElementById('errorNombre').classList.remove('invisible');
    }

    if ( typeof errores.descripcionTextarea !== 'undefined' ) {
        document.getElementById('errorDescripcion').innerHTML = errores.descripcionTextarea[0];
        document.getElementById('errorDescripcion').classList.remove('invisible');
    }

    if ( typeof errores.edificio !== 'undefined' ) {
        document.getElementById('errorEdificio').innerHTML = errores.edificio[0];
        document.getElementById('errorEdificio').classList.remove('invisible');
    }

    if ( typeof errores.imagen !== 'undefined' ) {
        document.getElementById('errorImagen').innerHTML = errores.imagen[0];
        document.getElementById('errorImagen').classList.remove('invisible');
    }
}

const inputFiles = document.querySelectorAll('.input-file');

Array.from(inputFiles).forEach(function (inputFile) {
    inputFile.addEventListener('change', function () {
        const spanArchivoSeleccionado = document.querySelector('.archivo-seleccionado > span');
        spanArchivoSeleccionado.innerHTML = inputFile.files[0].name;
    });
});

document.getElementById('editar').addEventListener('click', function (event) {
    event.preventDefault();

    const token = document.querySelector("input[name='_token']").value;
    const idComercio = document.querySelector("input[name='idComercio']").getAttribute('data-id-comercio');
    const formData = new FormData(document.forms.namedItem('formComercio'));
    const url = `/admin/comercios/${idComercio}`;

    isLoadingSpinner("editar", true);

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

        isLoadingSpinner("editar", true);

        setTimeout(() => {
            if ( typeof response.errors !== 'undefined' ) {
                isLoadingSpinner("editar", false);
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
                isLoadingSpinner("editar", false);
                Swal.fire({
                    icon: 'error',
                    title: 'Un momento...',
                    text: response.message
                })

                return;
            }

            if ( response.status == 'error' ) {
                isLoadingSpinner("editar", false);
                Swal.fire({
                    icon: 'error',
                    title: 'Un momento...',
                    text: response.message
                })

                return;
            }

            if ( response.status == 'success' ) {
                isLoadingSpinner("editar", 'done');
                Swal.fire({
                    icon: 'success',
                    title: 'Local actualizado',
                    showConfirmButton: false,
                    timer: 2000
                });

                setTimeout(function () {
                    window.location.href = '/admin/comercios';
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
