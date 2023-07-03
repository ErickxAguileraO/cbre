$(document).ready(function () {
    // Agregar input al presionar el botón
    $("#btn-agregar").click(function() {
        var newInput = 
          '<fieldset class="row row-input-form">' +
            '<input type="radio">' +
            '<div class="col-sm-4">' +
              '<div class="form-group">' +
                '<input id="" name="" class="form-control" data-maximo-caracteres="" type="text" tabindex="1" placeholder="Pregunta" />' +
              '</div>' +
            '</div>' +
            '<img src="/public/images/admin/sistema/delete.svg" class="btn btn-remove" alt="">' +
          '</fieldset>';
        $(".contenedor-dinamico").append(newInput);
      });

    // Eliminar input al presionar el botón
    $(document).on("click", ".btn-remove", function () {
        $(this).closest(".row-input-form").remove();
    });
});


$(".option-select-manual").hide();
  $(".select-manual").click(function() {
    $(".option-select-manual").toggle();
  })
