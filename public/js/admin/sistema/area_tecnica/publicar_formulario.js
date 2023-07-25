document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("postear-formulario").addEventListener("click", function (event) {

        var form_nombre = document.getElementById("form_nombre").value;
        var formData = new FormData();
        formData.append('formValue', document.getElementById("form_id").value);

            event.preventDefault();

            if(!form_nombre){
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "Debes completar todos los campos requeridos",
                    showConfirmButton: false,
                    timer: 1500,
                });
            }else{
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
                        isLoadingSpinner("postear-formulario", true);
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
                                    isLoadingSpinner("postear-formulario", 'done');
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
                                    isLoadingSpinner("postear-formulario", false);
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
                                isLoadingSpinner("postear-formulario", false);
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

    });
});
