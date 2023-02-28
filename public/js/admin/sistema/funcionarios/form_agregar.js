document.addEventListener('DOMContentLoaded', function () {
    function mostrarErroresValidacion(errores) {
        if ( typeof errores.nombre !== 'undefined' ) {
            document.getElementById('errorNombre').innerHTML = errores.nombre[0];
            document.getElementById('errorNombre').classList.remove('invisible');
        }
        
        if ( typeof errores.apellidos !== 'undefined' ) {
            document.getElementById('errorApellidos').innerHTML = errores.apellidos[0];
            document.getElementById('errorApellidos').classList.remove('invisible');
        }

        if ( typeof errores.telefono !== 'undefined' ) {
            document.getElementById('errorTelefono').innerHTML = errores.telefono[0];
            document.getElementById('errorTelefono').classList.remove('invisible');
        }

        if ( typeof errores.email !== 'undefined' ) {
            document.getElementById('errorEmail').innerHTML = errores.email[0];
            document.getElementById('errorEmail').classList.remove('invisible');
        }

        if ( typeof errores.foto !== 'undefined' ) {
            document.getElementById('errorFoto').innerHTML = errores.foto[0];
            document.getElementById('errorFoto').classList.remove('invisible');
        }

        if ( typeof errores.cargo !== 'undefined' ) {
            document.getElementById('errorCargo').innerHTML = errores.cargo[0];
            document.getElementById('errorCargo').classList.remove('invisible');
        }

        if ( typeof errores.edificio !== 'undefined' ) {
            document.getElementById('errorEdificio').innerHTML = errores.edificio[0];
            document.getElementById('errorEdificio').classList.remove('invisible');
        }
    }

		// Quitar mensajes de validación
    document.getElementById('nombre').addEventListener('input', function () {
        document.getElementById('errorNombre').classList.add('invisible');
    });

    document.getElementById('apellidos').addEventListener('input', function () {
        document.getElementById('errorApellidos').classList.add('invisible');
    });

    document.getElementById('telefono').addEventListener('input', function () {
        document.getElementById('errorTelefono').classList.add('invisible');
    });

    document.getElementById('email').addEventListener('input', function () {
        document.getElementById('errorEmail').classList.add('invisible');
    });

    document.getElementById('foto').addEventListener('input', function () {
        document.getElementById('errorFoto').classList.add('invisible');
    });

    // Quitar mensaje de select2
    $('#cargo').change(function () {
        document.getElementById('errorCargo').classList.add('invisible');;
    });

    $('#edificio').change(function () {
        document.getElementById('errorEdificio').classList.add('invisible');;
    });

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
        const formData = new FormData(document.forms.namedItem('formFuncionario'));
        const url = '/admin/funcionarios';
        
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
                title: 'Funcionario agregado',
                showConfirmButton: false,
                timer: 2000
            });

            setTimeout(function () {
                window.location.href = '/admin/funcionarios';
            }, 2000);
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Un momento...',
                text: error.message
            });
        });
    });
});