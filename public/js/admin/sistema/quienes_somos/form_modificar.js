let ckEditor;
ClassicEditor.create(document.querySelector('#texto'), {
    removePlugins: ['MediaEmbed'],
})
.then(editor => {
    ckEditor = editor;
});

/* const iniciarCkeditor = () => {
    const editors = document.querySelectorAll(".ckeditor-input");
    if (!editors) return;
    editors.forEach((editor) => {
        CKEDITOR.replace(editor, { removeButtons: "SImage" });
    });
}; */

document.getElementById("editar").addEventListener("click", function (event) {
    let form = document.querySelector("#form-quienes_somos");
    let texto = ckEditor.getData();
    //    let texto = CKEDITOR.instances.texto.getData();
    let formData = new FormData(form);
    formData.append("texto", texto);
    formData.append("_method", "PUT");

    event.preventDefault();

    isLoadingSpinner("editar", true);

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
                isLoadingSpinner("editar", true);
                setTimeout(() => {
                    if (response.success) {
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: response.success,
                            showConfirmButton: false,
                            timer: 1500,
                        });
                        isLoadingSpinner("editar", "done");
                        resetValidationMessages();
                        setTimeout(() => {
                            document.location.href = "/admin/quienes-somos";
                        }, 2000);
                    } else if (response.error) {
                        isLoadingSpinner("editar", false);
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
                isLoadingSpinner("editar", true);
                setTimeout(() => {
                    isLoadingSpinner("editar", false);
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
            isLoadingSpinner("editar", false);
        });
});

const inputFieldsIds = ['titulo', 'texto', 'imagen'];

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
