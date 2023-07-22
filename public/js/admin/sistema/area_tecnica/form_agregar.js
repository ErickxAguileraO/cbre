document.addEventListener('DOMContentLoaded', function () {
    document.getElementById("guardar").addEventListener("click", function (event) {
        event.preventDefault();

        // Mostrar alerta de confirmación con estilo de SweetAlert
        Swal.fire({
            icon: 'question',
            title: '¿Estás seguro de guardar esta observación?',
            showCancelButton: true,
            confirmButtonText: 'Si',
            cancelButtonText: 'No',
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario selecciona "Si", enviar el formulario
                isLoadingSpinner("guardar", true);
                fetch("/admin/formulario-area-tecnica/observacion", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector("input[name='_token']").value,
                        "Accept": "application/json"
                    },
                    body: new FormData(document.forms.namedItem("form-observacion")),
                })
                .then(function (response) {
                    return response.json();
                })
                .then(function (response) {
                    if ($.isEmptyObject(response.errors)) {
                        isLoadingSpinner("guardar", true);
                        setTimeout(() => {
                            if (response.success) {
                                Swal.fire({
                                    position: "center",
                                    icon: "success",
                                    title: response.success,
                                    showConfirmButton: false,
                                    timer: 1500,
                                });
                                isLoadingSpinner("guardar", 'done');
                                // resetValidationMessages();
                                setTimeout(() => {
                                    document.location.href = "/admin/formulario-area-tecnica";
                                }, 1000);

                            } else if (response.error) {
                                isLoadingSpinner("guardar", false);
                                // resetValidationMessages();
                                Swal.fire({
                                    position: "center",
                                    icon: "error",
                                    title: response.error,
                                    showConfirmButton: false,
                                    timer: 1500,
                                });
                            }
                            // Cerrar el modal
                            document.getElementById('modalObersacion').style.display = 'none';
                        }, 1000);

                    } else {
                        isLoadingSpinner("guardar", true);
                        setTimeout(() => {
                             isLoadingSpinner("guardar", false);
                            // resetValidationMessages();
                            // setValidationMessages(response);
                            Swal.fire({
                                position: "center",
                                icon: "error",
                                title: "Debes completar todos los campos",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                        // Cerrar el modal
                        document.getElementById('modalObersacion').style.display = 'none';
                        }, 1000);

                    }
                })
                .catch((mensajeError) => {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: "¡Ha ocurrido un error!",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    isLoadingSpinner("guardar", false);
                });
            } else {
                // Si el usuario selecciona "No" o cierra el cuadro de confirmación, no hacer nada
            }
        });
    });

    const inputFieldsIds = ['descripcion'];

    function setValidationMessages(response) {
        const errors = response.errors;
        for (const field in errors) {
          if (errors.hasOwnProperty(field)) {
            const fieldErrors = errors[field];
            const fieldIndex = inputFieldsIds.indexOf(field);

            if (fieldIndex >= 0) {
              const fieldId = inputFieldsIds[fieldIndex];
              const errorElement = document.getElementById(`${fieldId}_error`);
              errorElement.innerText = fieldErrors.join(', ');
              document.getElementById(`${fieldId}_error`).classList.remove('invisible');
            }
          }
        }
      }

      function resetValidationMessages() {
        inputFieldsIds.forEach(id => {
          document.getElementById(`${id}_error`).classList.add('invisible');
        });
    }

    //remueve el mensaje de error en tiempo real, al momento de volver a ingresar un valor en el input
        inputFieldsIds.forEach(field => {
        document.getElementById(field).addEventListener('input', function () {
            document.getElementById(`${field}_error`).classList.add('invisible');
        });
    });

        const inputFiles = document.querySelectorAll('.input-file');

        Array.from(inputFiles).forEach(function (inputFile) {
            inputFile.addEventListener('change', function () {
                const spanArchivoSeleccionado = document.querySelector('.archivo-seleccionado > span');
                spanArchivoSeleccionado.innerHTML = inputFile.files[0].name;
            });
        });
    });
