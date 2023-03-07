
var regionName = 'Arica y Parinacota'; //variable inicializadora con el nombre inicial de la primera región

cargarRegiones();
cargarComunasPorRegion();

$( '#region' ).change(function() {
    regionName = document.getElementById("region").value;
    cargarComunasPorRegion()
});

document.getElementById("guardar").addEventListener("click", function (event) {
    event.preventDefault();
    isLoadingSpinner(true);
    fetch("/admin/submercados", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector("input[name='_token']")
                .value,
        },
        body: new FormData(document.forms.namedItem("form-submercados")),
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
                            document.location.href = "/admin/submercados";
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
        document.getElementById("guardar").setAttribute("disabled", true);
    }
    if (isLoading == false) {
        document.getElementById("loading").classList.remove("d-block");
        document.getElementById("loading").classList.add("d-none");
        document.getElementById("default").classList.remove("d-none");
        document.getElementById("default").classList.add("d-block");
        document.getElementById("guardar").removeAttribute("disabled");
    }
    if (isLoading == 'done') {
        document.getElementById("loading").classList.remove("d-block");
        document.getElementById("loading").classList.add("d-none");
        document.getElementById("default").classList.remove("d-none");
        document.getElementById("default").classList.add("d-block");
        document.getElementById("guardar").setAttribute("disabled", true);
    }
}

const inputFieldsIds = ['nombre', 'estado', 'comuna'];

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

function cargarComunasPorRegion(){
    let comunaSelect = $("#comuna");
    comunaSelect.empty();
    const comunas = obtenerListaComunasPorRegion();
    for (let i=0; i<comunas.length; i++) {
        comunaSelect.append('<option value="' + comunas[i].com_id + '">' + comunas[i].com_nombre + '</option>');
    }
}

function cargarRegiones(){
    let regionSelect = $("#region");
    regionSelect.empty();
    const regiones = obtenerListaRegiones();
    for (let i=0; i<regiones.length; i++) {
            regionSelect.append('<option value="' + regiones[i].reg_nombre + '">' + regiones[i].reg_nombre + '</option>');
    }
}

function obtenerListaComunas(){
    let comunas = "";
    $.ajax({
        method: "GET",
        url:'/admin/comunas/get/list',
        async: false,
        success: (data) => {
            comunas = data;
        },
        error: (error) => console.error("Error al modificar estado:", error)
    });
    return comunas;
}

function obtenerListaComunasPorRegion(){
    let comunas = "";
    $.ajax({
        method: "GET",
        url:'/admin/comunas/get/list/'+regionName,
        async: false,
        success: (data) => {
            comunas = data;
        },
        error: (error) => console.error("Error al modificar estado:", error)
    });
    return comunas;
}

//utilizando la misma funcion obtenerListaComunas, que también trae su respectiva región
//Se extrae la información referente a las regiones y se eliminan los duplicados
function obtenerListaRegiones(){
    let comunas = obtenerListaComunas();
    let regiones = [];
    comunas.forEach(function (element, i) {
            regiones.push({ reg_nombre: element.region['reg_nombre'], reg_id: element.region['reg_id'] });
    });
    return regiones.filter((v,i,a)=>a.findIndex(v2=>(v2.reg_id===v.reg_id))===i) //remove duplicates
}
