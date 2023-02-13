/**
 * Validaciones para caracteres aceptados en los inputs.
 * Se requiere agregar una clase o una propiedad al input, 
 * dependiendo del caso.
 */

/**
 * Solo números
 * 
 * Agregar la clase "solo-numeros".
 */
const elementosNumeros = document.getElementsByClassName('solo-numeros');

Array.from(elementosNumeros).forEach(elemento => {
    elemento.addEventListener('keydown', function (event) {
        if ( !(/[0-9\/b]/i.test(event.key)) ) {
            event.preventDefault();
        };
    });
});

/**
 * Solo letras
 * 
 * Agregar la clase "solo-letras".
 */
 const elementosLetras = document.getElementsByClassName('solo-letras');

 Array.from(elementosLetras).forEach(elemento => {
     elemento.addEventListener('keydown', function (event) {
         if ( !(/[aA-zZñÑ ]/i.test(event.key)) ) {
             event.preventDefault();
         };
     });
 });

 /**
  * Número máximo de caracteres
  * 
  * Se debe agregar la propiedad "data-maximo-caracteres".
  */
const inputsMaximoCatacteres = document.querySelectorAll('[data-maximo-caracteres]');

Array.from(inputsMaximoCatacteres).forEach(elemento => {
    elemento.addEventListener('input', function (event) {
        const maximoCaracteres = this.getAttribute('data-maximo-caracteres');

        if ( this.value.length > maximoCaracteres ) {
            this.value = this.value.slice(0, maximoCaracteres);
        }
    });
});
