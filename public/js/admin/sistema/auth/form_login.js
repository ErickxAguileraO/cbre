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

    const token = document.querySelector("input[name='_token']").value;
    const formData = new FormData(document.forms.namedItem('formLogin'));
    const url = '/login';
    
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
                title: '¡Bienvenido!',
                showConfirmButton: false,
                timer: 2000
            });

            setTimeout(function () {
                window.location.href = response.data.urlHome;
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
