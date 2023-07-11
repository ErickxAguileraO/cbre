document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll("#eliminar-formulario").forEach(function (element) {
        element.addEventListener("click", function (event) {
            let urlEliminar = `/admin/formulario-area-tecnica/${
                document.getElementById("form_id").value
            }`;
            event.preventDefault();
            Swal.fire({
                title: "¿Estás seguro?",
                text: "¡No podrás revertir esto!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#005157",
                cancelButtonColor: "#343a40",
                confirmButtonText: "¡Sí, Eliminalo!",
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(urlEliminar, {
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
                                    document.location.href =
                                        "/admin/formulario-area-tecnica";
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
        });
    });
});
