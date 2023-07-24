document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("guardar").addEventListener("click", function (event) {
            isLoadingSpinner("guardar", true);
            setTimeout(() => {
                isLoadingSpinner("guardar", 'done')
                document.location.href =
                    "/admin/formulario-area-tecnica";
            }, 2500);
    });
});


