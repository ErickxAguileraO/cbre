//document.addEventListener('DOMContentLoaded', function () {
// document.getElementById("guardar").addEventListener("click", function (event) {
function eliminar(url) {
    Swal.fire({
        title: "¿Estás seguro?",
        text: "¡No podrás revertir esto!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "¡Sí, Eliminalo!",
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(url, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN":
                        document.querySelector("[name=_token]").value,
                },
            })
                .then((response) => response.json())
                .then((response) => {
                    if (response.success) {
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: response.success,
                            showConfirmButton: false,
                            timer: 1500,
                        });
                        setTimeout(() => {
                            document.location.href = "/admin/caracteristicas";
                        }, 1500);
                    } else {
                        Swal.fire({
                            position: "center",
                            icon: "error",
                            title: response.error,
                            showConfirmButton: false,
                            timer: 1500,
                        });
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
                });
        }
    });
}


//});

/*  function setValidationMessages(response){
    for (let i=0; i<response.errors.length; i++) {
        if(response.errors[i].toLowerCase().includes("consulta")){
            document.getElementById('consulta_error').innerText = response.errors[i];
        }
        if(response.errors[i].toLowerCase().includes("cuenta")){
            document.getElementById('servicio_error').innerText = response.errors[i];
        }
    }
}

function resetValidationMessages(){
    document.getElementById('consulta_error').innerText = '';
    document.getElementById('servicio_error').innerText = '';
} */


