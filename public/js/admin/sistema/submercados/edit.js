
var subMercado = obtenerSubmercado();
var regionName = subMercado.comuna.region.reg_nombre; //variable inicializadora con el nombre inicial de la primera región
var check = true; //permite establecer si el select de región cambió, para así no mostrar la comuna inicial y limpiar completamente el select de comunas

//var regionName =  obtenerListaRegiones().find(region => region.reg_nombre === 'Arica y Parinacota').reg_nombre;

cargarRegiones();
cargarComunasPorRegion();

function obtenerSubmercado(){
    let subMercado = "";
    $.ajax({
        method: "GET",
        url:'/admin/submercados/get/single/' + document.getElementById("sub_id").value,
        async: false,
        success: (data) => {
            subMercado = data;
        },
        error: (error) => console.error("Error:", error)
    });
    return subMercado;
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
        error: (error) => console.error("Error:", error)
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
        error: (error) => console.error("Error:", error)
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


function cargarComunasPorRegion(){
        let comunaSelect = $("#comuna");
        comunaSelect.empty();
        const comunas = obtenerListaComunasPorRegion();
        if(check){
            comunaSelect.append('<option value="' + subMercado.comuna.com_id + '">' + subMercado.comuna.com_nombre + '</option>');
        }
        if(check === false && subMercado.comuna.region.reg_nombre == document.getElementById("region").value){
            comunaSelect.append('<option value="' + subMercado.comuna.com_id + '">' + subMercado.comuna.com_nombre + '</option>');
        }
        for (let i=0; i<comunas.length; i++) {
            if(subMercado.comuna.com_nombre !== comunas[i].com_nombre){
                comunaSelect.append('<option value="' + comunas[i].com_id + '">' + comunas[i].com_nombre + '</option>');
            }
        }
        //$('#comunaSelect').niceSelect('update'); //se actualiza el nice select
}

function cargarRegiones(){
        //cargar select con lista de regiones
        let regionSelect = $("#region");
        regionSelect.empty();
        const regiones = obtenerListaRegiones();
        regionSelect.append('<option value="' + regionName + '">' + regionName + '</option>');
        for (let i=0; i<regiones.length; i++) {
             if(regionName !== regiones[i].reg_nombre){
                regionSelect.append('<option value="' + regiones[i].reg_nombre + '">' + regiones[i].reg_nombre + '</option>');
             }
        }
        //$('#regionSelect').niceSelect('update');
}

$( '#region' ).change(function() {
    check = false;
    let e = document.getElementById("region");
	regionName = e.value; // 2
	//let strUser = e.options[e.selectedIndex].text; //test2
    cargarComunasPorRegion()
});

document.getElementById("editar").addEventListener("click", function (event) {
    let form = document.querySelector("#form-submercados");
    let formData = new FormData(form);
    formData.append("_method", "PUT");
    event.preventDefault();
    isLoadingSpinner(true);
    fetch("/admin/submercados/" + document.getElementById("sub_id").value, {
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
            case "nombre":
              document.getElementById(`${field}_error`).innerText = fieldErrors[i];
              break;
            case "estado":
              document.getElementById(`${field}_error`).innerText = fieldErrors[i];
              break;
            case "comuna":
              document.getElementById(`${field}_error`).innerText = fieldErrors[i];
              break;
          }
        }
      }
    }
  }

  function resetValidationMessages() {
    document.getElementById('nombre_error').innerText = '';
    document.getElementById('comuna_error').innerText = '';
    document.getElementById('estado_error').innerText = '';
}

const inputFiles = document.querySelectorAll('.input-file');

Array.from(inputFiles).forEach(function (inputFile) {
    inputFile.addEventListener('change', function () {
        const spanArchivoSeleccionado = document.querySelector('.archivo-seleccionado > span');
        spanArchivoSeleccionado.innerHTML = inputFile.files[0].name;
    });
});
