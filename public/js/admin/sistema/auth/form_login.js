const token = document.querySelector("input[name='_token']").value;

document.getElementById('email').addEventListener('input', function () {
    document.getElementById('errorEmail').classList.add('invisible');
})

document.getElementById('password').addEventListener('input', function () {
    document.getElementById('errorPassword').classList.add('invisible');
})

function mostrarErroresValidacion(errores) {
    if ( typeof errores.email !== 'undefined' ) {
        document.getElementById('errorEmail').innerHTML = errores.email[0];
        document.getElementById('errorEmail').classList.remove('invisible');
    }

    if ( typeof errores.password !== 'undefined' ) {
        document.getElementById('errorPassword').innerHTML = errores.password[0];
        document.getElementById('errorPassword').classList.remove('invisible');
    }
}

const inputFiles = document.querySelectorAll('.input-file');

document.getElementById('ingresarButton').addEventListener('click', function (event) {
    event.preventDefault();

    const formData = new FormData(document.forms.namedItem('formLogin'));
    const url = '/login';

    isLoadingSpinner("ingresarButton", true);

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

        isLoadingSpinner("ingresarButton", true);

    setTimeout(() => {
        if ( typeof response.errors !== 'undefined' ) {
            isLoadingSpinner("ingresarButton", false);
            mostrarErroresValidacion(response.errors);

            return;
        }

        if ( typeof response.status == 'undefined' ) {
            isLoadingSpinner("ingresarButton", false);
            Swal.fire({
                icon: 'error',
                title: 'Un momento...',
                confirmButtonColor: '#005157',
                text: response.message
            })

            return;
        }

        if ( response.status == 'error' ) {
            isLoadingSpinner("ingresarButton", false);
            Swal.fire({
                icon: 'error',
                title: 'Un momento...',
                confirmButtonColor: '#005157',
                text: response.message
            })

            return;
        }

        if ( response.status == 'success' ) {
            isLoadingSpinner("ingresarButton", 'done');
            Swal.fire({
                icon: 'success',
                title: '¡Bienvenido!',
                showConfirmButton: false,
                timer: 2000
            });

            setTimeout(function () {
                window.location.href = response.data.urlHome;
            }, 2000);
        }

    }, 1000);

    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Un momento...',
            confirmButtonColor: '#005157',
            text: error.message
        });
    });
});

document.getElementById('passwordResetButton').addEventListener('click', function (event) {
    event.preventDefault();

    (async () => {
        const { value: email } = await Swal.fire({
            title: 'Ingresa tu email',
            input: 'email',
            text: 'Te enviaremos un mensaje con las instrucciones para cambiar tu contraseña.',
            confirmButtonColor: '#005157',
            inputPlaceholder: 'ejemplo@email.com',
            inputValidator: (valorInput) => {
                if ( valorInput == '' ) {
                    return 'Debes ingresar un email.'
                }
            }
        })

        if ( email ) {
            url = '/forgot-password';
            let datosPost = {
                email: email
            };

            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(datosPost)
            })
            .then(response => response.json().then(data => ({ok: response.ok, body: data})))
            .then(function (response) {
                if ( typeof response.body.errors !== 'undefined' && typeof response.body.errors.email !== 'undefined' ) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Un momento...',
                        confirmButtonColor: '#005157',
                        text: response.body.errors.email[0]
                    });

                    return;
                }

                if ( !response.ok ) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Un momento...',
                        confirmButtonColor: '#005157',
                        text: response.body.message
                    });

                    return;
                }

                Swal.fire({
                    icon: 'success',
                    title: 'Mensaje enviado',
                    confirmButtonColor: '#005157',
                    text: response.body.message
                });
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Un momento...',
                    confirmButtonColor: '#005157',
                    text: error.message
                });
            });
        }
    })();
});
