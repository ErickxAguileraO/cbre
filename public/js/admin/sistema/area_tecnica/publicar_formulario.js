document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("postear-formulario").addEventListener("click", function (event) {

        var formData = new FormData();
        formData.append('formValue', document.getElementById("form_id").value);

            event.preventDefault();
            Swal.fire({
                title: "¿Estás seguro?",
                text: "¡No podrás revertir esto!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#005157",
                cancelButtonColor: "#343a40",
                confirmButtonText: "¡Sí, Publicalo!",
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('/admin/formulario-area-tecnica/post/formulario', {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector("input[name='_token']")
                                .value,
                            "Accept": "application/json"
                        },
                        body: formData
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
