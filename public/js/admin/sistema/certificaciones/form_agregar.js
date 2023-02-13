document.addEventListener('DOMContentLoaded', function () {
    function mostrarErroresValidacion(errores) {
        document.getElementById('errorNombre').innerHTML = typeof errores.nombre !== 'undefined' ? errores.nombre[0] : '';
        document.getElementById('errorImagen').innerHTML = typeof errores.imagen !== 'undefined' ? errores.imagen[0] : '';
        document.getElementById('errorPosicion').innerHTML = typeof errores.posicion !== 'undefined' ? errores.posicion[0] : '';
        document.getElementById('errorEstado').innerHTML = typeof errores.estado !== 'undefined' ? errores.estado[0] : '';

        toggleErroresValidacion();
    }

    document.getElementById('nombre').addEventListener('input', function () {
        document.getElementById('errorNombre').classList.add('invisible');
    })

    document.getElementById('imagen').addEventListener('input', function () {
        document.getElementById('errorImagen').classList.add('invisible');
    })

    document.getElementById('posicion').addEventListener('input', function () {
        document.getElementById('errorPosicion').classList.add('invisible');
    })

    document.getElementById('estado').addEventListener('input', function () {
        document.getElementById('errorEstado').classList.add('invisible');
    })

    function toggleErroresValidacion() {
        const alertasError = document.querySelectorAll('small.field-message-alert');
        
        Array.from(alertasError).forEach(alerta => {
            if ( alerta.classList.contains('invisible') ) {
                alerta.classList.remove('invisible');
            } else {
                alerta.classList.add('invisible');
            }
        });
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
        const formData = new FormData(document.forms.namedItem('formCertificacion'));
        const url = '/admin/certificaciones';
        
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

            if ( response.status == 'error' ) {
                Swal.fire({
                    icon: 'error',
                    title: 'Un momento...',
                    text: response.message
                })

                return;
            }

            Swal.fire({
                icon: 'success',
                title: 'Certificación agregada',
                showConfirmButton: false,
                timer: 2000
            })

            setTimeout(function () {
                window.location.href = '/admin/certificaciones';
            }, 2000);
        })
        .catch(function (error) {
            console.log(error.message);
        });
    });
});