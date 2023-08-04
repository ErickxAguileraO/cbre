document.querySelectorAll("#eliminar-documento").forEach(function (element) {
    element.addEventListener("click", function (event) {

        const documentoId = event.target.previousElementSibling.value;

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
                fetch(`/admin/edificios/delete/${documentoId}`, {
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

                                const container = event.target.closest(
                                    "#documentos-cargados-container"
                                );
                                if (container) {
                                    container.remove();
                                }

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

$("#agregar-documentos").click(function () {
    let html_file = '<div class="my-3"> ';
    html_file +=
        '<input type="text"  name="nombres_documentos[]" class="form-control col-sm-5" placeholder="Nombre del documento">';
    html_file +=
        '<input style="margin-bottom: 0px;" type="file" name="documentos[]" class="input-file mt-3">';
    html_file += "<a>";
    html_file +=
        '<i class="fas fa-trash delete_file" style="font-size: 15px;margin-left: 20px;color: #cd2222;" ></i>';
    html_file += "</a>";
    html_file += "</div>";

    $("#documentos-container").append(html_file);
});

$(document).on("click", ".delete_file", function () {
    $(this).parent().parent().children().remove();
});
