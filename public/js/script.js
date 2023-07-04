// Seleccion individual
$(document).ready(function () {
  // Agregar input al presionar el botón
  $(".btn-agregar").click(function () {
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
    $(this).prev().append(newInput);
  });

  // Eliminar input al presionar el botón
  $(document).on("click", ".btn-remove", function () {
    $(this).closest(".row-input-form").remove();
  });
});

// Seleccion multiple
$(document).ready(function () {
  // Agregar input al presionar el botón
  $(".btn-agregar-2").click(function () {
    var newInput =
      '<fieldset class="row row-input-form">' +
      '<input type="checkbox">' +
      '<div class="col-sm-4">' +
      '<div class="form-group">' +
      '<input id="" name="" class="form-control" data-maximo-caracteres="" type="text" tabindex="1" placeholder="Pregunta" />' +
      '</div>' +
      '</div>' +
      '<img src="/public/images/admin/sistema/delete.svg" class="btn btn-remove" alt="">' +
      '</fieldset>';
    $(this).prev().append(newInput);
  });

  // Eliminar input al presionar el botón
  $(document).on("click", ".btn-remove", function () {
    $(this).closest(".row-input-form").remove();
  });
});





// Agregar y eliminar pregunta completa
$(document).ready(function () {
  // Agregar input al presionar el botón
  $(document).on("click", ".btn-agregar", function () {
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
    $(this).prev().append(newInput);
  });

  // Eliminar input al presionar el botón
  $(document).on("click", ".btn-remove", function () {
    $(this).closest(".row-input-form").remove();
  });


  // Agregar input al presionar el botón
  $(document).on("click", ".btn-agregar-nueva-pregunta", function () {
    var newInput =
      '<div class="div-formulario-n">' +
      '<fieldset class="row row-responsive">' +
      '<div class="col-xl">' +
      '<div class="form-group">' +
      '<input id="" name="" class="form-control" type="text" tabindex="1" placeholder="Pregunta" />' +
      '<small id="" class="field-message-alert absolute"></small>' +
      '</div>' +
      '</div>' +
      '<div class="col-sm-4">' +
      '<div class="form-group">' +
      '<select id="" name="" class="form-control" tabindex="4" style="width:100%;">' +
      '<option value="1">Seleccion individual</option>' +
      '</select>' +
      '<small id="" class="field-message-alert absolute"></small>' +
      '</div>' +
      '</div>' +
      '</fieldset>' +
      '<div class="contenedor-dinamico">' +
      '<fieldset class="row row-input-form">' +
      '<input type="radio">' +
      '<div class="col-sm-4">' +
      '<div class="form-group">' +
      '<input id="" name="" class="form-control" type="text" tabindex="1" placeholder="Pregunta" />' +
      '</div>' +
      '</div>' +
      '</fieldset>' +
      '</div>' +
      '<div class="btn-agregar row-global cursor-pointer color-texto-cbre">' +
      '<i class="far fa-plus-circle"></i>' +
      '<p>Añadir otra opción</p>' +
      '</div>' +
      '<div class="opciones-pregunta grid-header-2">' +
      '<div class="modalFile__abrirBtn">' +
      '<i class="far fa-paperclip"></i>' +
      'Adjuntar archivos' +
      '</div>' +
      '<div class="row opciones-extras-formulario">' +
      '<div class="row-global align-center">' +
      '<p>Obligatorio</p>' +
      '<label class="switch">' +
      '<input type="checkbox" codigo="">' +
      '<span class="slider round"></span>' +
      '</label>' +
      '</div>' +
      '<div class="btn-remove-pregunta">' +
      '<p>Eliminar pregunta</p>' +
      '<img src="/public/images/admin/sistema/delete.svg" class="btn-remove" alt="">' +
      '</div>' +
      '</div>' +
      '</div>' +
      '</div>';
    $(".contenedor-form-preguntas").append(newInput);
  });

  // Eliminar input al presionar el botón
  $(document).on("click", ".btn-remove-pregunta", function () {
    $(this).closest(".div-formulario-n").remove();
  });

  $(document).on("click", ".modalFile__abrirBtn", function () {
    $(".contenedor__modalFile").css("display", "flex");
  });
});



$(".option-select-manual").hide();
$(".select-manual").click(function () {
  $(".option-select-manual").toggle();
})



// Modal Adjuntar archivos
$(".modalFile__abrirBtn").on('click', function () {
  $(".contenedor__modalFile").css("display", "flex");
});

$(".modalFile__cerrarBtn").on('click', function () {
  $(".contenedor__modalFile").css("display", "none");
});





