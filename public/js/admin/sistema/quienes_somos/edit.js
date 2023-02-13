window.addEventListener("load", () => {
    iniciarCkeditor();
});

const iniciarCkeditor = () => {
    const editors = document.querySelectorAll(".ckeditor-input");
    if (!editors) return;
    editors.forEach((editor) => {
        CKEDITOR.replace(editor, { removeButtons: "SImage" });
    });
};

document.getElementById("editar").addEventListener("click", function (event) {
    let form = document.querySelector("#form-quienes_somos");
    let texto = CKEDITOR.instances.texto.getData();
    let formData = new FormData(form);
    formData.append("texto", texto);
    formData.append("_method", "PUT");

    event.preventDefault();

    isLoadingSpinner(true);

    fetch("/admin/quienes-somos/" + document.getElementById("qus_id").value, {
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
                        isLoadingSpinner("done");
                        resetValidationMessages();
                        setTimeout(() => {
                            document.location.href = "/admin/quienes-somos";
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
    if (isLoading == "done") {
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
                    case "titulo":
                        document.getElementById(`${field}_error`).innerText =
                            fieldErrors[i];
                        break;
                    case "texto":
                        document.getElementById(`${field}_error`).innerText =
                            fieldErrors[i];
                        break;
                    case "imagen":
                        document.getElementById(`${field}_error`).innerText =
                            fieldErrors[i];
                        break;
                }
            }
        }
    }
}

function resetValidationMessages() {
    document.getElementById("titulo_error").innerText = "";
    document.getElementById("texto_error").innerText = "";
    document.getElementById("imagen_error").innerText = "";
}

const inputFiles = document.querySelectorAll('.input-file');

Array.from(inputFiles).forEach(function (inputFile) {
    inputFile.addEventListener('change', function () {
        const spanArchivoSeleccionado = document.querySelector('.archivo-seleccionado > span');
        spanArchivoSeleccionado.innerHTML = inputFile.files[0].name;
    });
});
