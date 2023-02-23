//$("#guardar").on("click", function (event) {
    document.getElementById("btn-contacto").addEventListener("click", function (event) {
        event.preventDefault();
        isLoadingSpinner(true);
        fetch("/contacto/store", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector("input[name='_token']")
                    .value,
            },
            body: new FormData(document.forms.namedItem("form-contacto")),
        })
            .then(function (response) {
                return response.json();
            })
            .then(function (response) {
                if ($.isEmptyObject(response.errors)) {
                    isLoadingSpinner(true);
                    setTimeout(() => {
                        if (response.success) {
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: response.success,
                                showConfirmButton: false,
                                timer: 3500,
                            });
                            isLoadingSpinner('done');
                            resetValidationMessages();
                            setTimeout(() => {
                                document.location.href = "/";
                            }, 4000);
                        } else if (response.error) {
                            isLoadingSpinner(false);
                            resetValidationMessages();
                            Swal.fire({
                                position: "center",
                                icon: "error",
                                title: response.error,
                                showConfirmButton: false,
                                timer: 1500,
                            });
                        }
                    }, 1000);
                } else {
                    isLoadingSpinner(true);
                    setTimeout(() => {
                        isLoadingSpinner(false);
                        resetValidationMessages();
                        setValidationMessages(response);
                        Swal.fire({
                            position: "center",
                            icon: "error",
                            title: "Debes completar todos los campos",
                            showConfirmButton: false,
                            timer: 1500,
                        });
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
                isLoadingSpinner(false);
            });
    });

    function isLoadingSpinner(isLoading) {
        if (isLoading == true) {
            document.getElementById("btn-contacto").disabled = true;
            document.getElementById("btn-spinner").style.display = "block";
        }
        if (isLoading == false) {
            document.getElementById("btn-contacto").disabled = false;
            document.getElementById("btn-spinner").style.display = "none";
        }
        if (isLoading == 'done') {
            document.getElementById("btn-contacto").disabled = true;
            document.getElementById("btn-spinner").style.display = "none";
        }
    }

    const inputFieldsIds = ['nombre', 'email', 'telefono', 'mensaje'];

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
            }
          }
        }
      }

      function resetValidationMessages() {
        inputFieldsIds.forEach(id => {
          document.getElementById(`${id}_error`).innerText = '';
        });
    }

    //remueve el mensaje de error en tiempo real, al momento de volver a ingresar un valor en el input
        inputFieldsIds.forEach(field => {
        document.getElementById(field).addEventListener('input', function () {
            document.getElementById(`${field}_error`).innerText = '';
        });
    });
