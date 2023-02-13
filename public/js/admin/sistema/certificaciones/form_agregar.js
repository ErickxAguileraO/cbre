document.addEventListener('DOMContentLoaded', function () {
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
            if ( response.status == 'error' ) {
                return;
            }

        Swal.fire({
            icon: 'success',
            title: 'Certificación agregada',
            showConfirmButton: false,
            timer: 2000
            })
        })
        .catch(function (error) {
            console.log(error.message);
        });
    });
});