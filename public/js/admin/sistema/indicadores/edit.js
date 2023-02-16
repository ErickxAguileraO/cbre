
document.getElementById("editar").addEventListener("click", function (event) {
    let form = document.querySelector("#form-indicadores");
    let formData = new FormData(form);
    formData.append("_method", "PUT");
    event.preventDefault();
    isLoadingSpinner(true);
    fetch("/admin/indicadores/" + document.getElementById("ind_id").value, {
        headers: {
            "X-CSRF-TOKEN": document.querySelector("input[name='_token']")
                .value,
        },
        method: "POST",
        body: formData,
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
                            timer: 1500,
                        });
                        isLoadingSpinner('done');
                        resetValidationMessages();
                        setTimeout(() => {
                            document.location.href = "/admin/indicadores";
                        }, 2000);
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
        document.getElementById("default").classList.remove("d-block");
        document.getElementById("default").classList.add("d-none");
        document.getElementById("loading").classList.remove("d-none");
        document.getElementById("loading").classList.add("d-block");
        document.getElementById("editar").setAttribute("disabled", true);
    }
    if (isLoading == false) {
        document.getElementById("loading").classList.remove("d-block");
        document.getElementById("loading").classList.add("d-none");
        document.getElementById("default").classList.remove("d-none");
        document.getElementById("default").classList.add("d-block");
        document.getElementById("editar").removeAttribute("disabled");
    }
    if (isLoading == 'done') {
        document.getElementById("loading").classList.remove("d-block");
        document.getElementById("loading").classList.add("d-none");
        document.getElementById("default").classList.remove("d-none");
        document.getElementById("default").classList.add("d-block");
        document.getElementById("editar").setAttribute("disabled", true);
    }
}

function setValidationMessages(response) {
    const errors = response.errors;
    for (const field in errors) {
      if (errors.hasOwnProperty(field)) {
        const fieldErrors = errors[field];
        for (let i = 0; i < fieldErrors.length; i++) {
          switch (field.toLowerCase()) {
            case "edificios_administrados":
              document.getElementById(`${field}_error`).innerText = fieldErrors[i];
              break;
            case "confia_en_nosotros":
              document.getElementById(`${field}_error`).innerText = fieldErrors[i];
              break;
            case "en_todo_chile":
              document.getElementById(`${field}_error`).innerText = fieldErrors[i];
              break;
              case "en_todo_chile2":
                document.getElementById(`${field}_error`).innerText = fieldErrors[i];
                break;
          }
        }
      }
    }
  }

  function resetValidationMessages() {
    document.getElementById('edificios_administrados_error').innerText = '';
    document.getElementById('confia_en_nosotros_error').innerText = '';
    document.getElementById('en_todo_chile_error').innerText = '';
    document.getElementById('en_todo_chile2_error').innerText = '';
}

const inputFiles = document.querySelectorAll('.input-file');

Array.from(inputFiles).forEach(function (inputFile) {
    inputFile.addEventListener('change', function () {
        const spanArchivoSeleccionado = document.querySelector('.archivo-seleccionado > span');
        spanArchivoSeleccionado.innerHTML = inputFile.files[0].name;
    });
});
