document.addEventListener('DOMContentLoaded', function () {
    document.getElementById("guardar").addEventListener("click", function (event) {
        event.preventDefault();
        isLoadingSpinner("guardar", true);
        fetch("/admin/administradores", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector("input[name='_token']")
                    .value,
                "Accept": "application/json"
            },
            body: new FormData(document.forms.namedItem("form-administrador")),
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
                            resetValidationMessages();
                            setTimeout(() => {
                                document.location.href = "/admin/administradores";
                            }, 2000);
                        } else if (response.error) {
                            isLoadingSpinner("guardar", false);
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
                    isLoadingSpinner("guardar", true);
                    setTimeout(() => {
                        isLoadingSpinner("guardar", false);
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
            .catch((error) => {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "¡Ha ocurrido un error!",
                    showConfirmButton: false,
                    timer: 1500,
                });
                isLoadingSpinner("guardar", false);
            });
    });

    const inputFieldsIds = ['nombre', 'apellido', 'email']; //'password', 'password_confirmation'

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

//permite mostrar y ocultar el contenido de los input del tipo password, utilizando un icono como botón
/*     document.addEventListener('DOMContentLoaded', function() {
        var passwordToggleIcons = document.querySelectorAll('.password-toggle-icon');
        passwordToggleIcons.forEach(function(icon) {
          icon.addEventListener('click', function() {
            var input = this.parentNode.querySelector('.password-input');
            if (input.type === 'password') {
              input.type = 'text';
              this.classList.remove('fa-eye');
              this.classList.add('fa-eye-slash');
            } else {
              input.type = 'password';
              this.classList.remove('fa-eye-slash');
              this.classList.add('fa-eye');
            }
          });
        });
      }); */
});
