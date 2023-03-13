document.getElementById('email').addEventListener('input', function () {
    document.getElementById('errorEmail').classList.add('invisible');
})

document.getElementById('password').addEventListener('input', function () {
    document.getElementById('errorPassword').classList.add('invisible');
})

document.getElementById('password_confirmation').addEventListener('input', function () {
    document.getElementById('errorPasswordConfirmation').classList.add('invisible');
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

    if ( typeof errores.password_confirmation !== 'undefined' ) {
        document.getElementById('errorPasswordConfirmation').innerHTML = errores.password_confirmation[0];
        document.getElementById('errorPasswordConfirmation').classList.remove('invisible');
    }
}

document.getElementById('actualizarButton').addEventListener('click', function (event) {
    event.preventDefault();

    const token = document.querySelector("input[name='_token']").value;
    const formData = new FormData(document.forms.namedItem('formUpdatePassword'));
    const url = '/reset-password';

    isLoadingSpinner("actualizarButton", true);

    fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(response => response.json().then(data => ({ok: response.ok, body: data})))
    .then(function (response) {

        isLoadingSpinner("actualizarButton", true);

        setTimeout(() => {
            if ( typeof response.body.errors !== 'undefined' ) {
                isLoadingSpinner("actualizarButton", false);
                mostrarErroresValidacion(response.body.errors);

                return;
            }

            if ( !response.ok ) {
                isLoadingSpinner("actualizarButton", false);
                Swal.fire({
                    icon: 'error',
                    title: 'Un momento...',
                    confirmButtonColor: '#005157',
                    text: response.body.message
                })

                return;
            }

                isLoadingSpinner("actualizarButton", 'done');
                Swal.fire({
                    icon: 'success',
                    title: 'Contraseña actualizada',
                    showConfirmButton: false,
                    timer: 2000
                });

                setTimeout(function () {
                    window.location.href = '/login';
                }, 2000);

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
