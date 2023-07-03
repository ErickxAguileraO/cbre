// -----TABS-----

// Muestro el primer contenido
document.querySelector(".tab__contenido").style.display = "block";
document.querySelector(".tab__boton").classList.add('tab__boton--active');

// Muestro por default el nombre del primer tab en el carrusel
document.querySelector("#tab__nombreTab").textContent = document.querySelector(".tab__boton--active").textContent;
document.querySelector("#tab__nombreTab").style.color = "#4a5154";

function mostrarTab(event, nombreTab) {
    let i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tab__contenido");

    // Oculta todos los contenido
    document.querySelectorAll(".tab__contenido").forEach(function (contenido) {
        contenido.style.display = "none";
    });

    // Mustra el contenido del tab seleccionado
    tablinks = document.getElementsByClassName("tab__boton");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" tab__boton--active", "");
    }
    document.getElementById(nombreTab).style.display = "block";
    event.currentTarget.className += " tab__boton--active";


    //cambiar nombre de opcion Acordeon responsivo
    document.querySelector("#tab__nombreTab").style.color = "#4a5154";
    document.querySelector("#tab__nombreTab").textContent = document.querySelector(".tab__boton--active").textContent;
}




//-----ACORDEON RESPONSIVO-----

// Oculto la lista de botones dependiendo el ancho
window.addEventListener('resize', function (event) {
    let w = window.innerWidth;

    if (parseInt(w) <= 1200) {
        document.querySelector('.tab__lista-botones').style.display = "none";
        btnAcordeonTab.style.backgroundImage = 'url(/public/css/componentes/tab/imagenes/arrow-down-s-fill.svg)';
    } else {
        document.querySelector('.tab__lista-botones').style.display = "flex";

    }
}, true);

//Oculto y muestro la lista de botoes al precionar "tab__botonAcordeon"
let btnAcordeonTab = document.querySelector(".tab__botonAcordeon");
let listaBtnTab = document.querySelector(".tab__lista-botones");
let estadoVisible = false;

btnAcordeonTab && btnAcordeonTab.addEventListener('click', function () {
    if (estadoVisible) {
        listaBtnTab.style.display = 'none'; // Ocultar el elemento
        btnAcordeonTab.style.backgroundImage = 'url(/public/css/componentes/tab/imagenes/arrow-down-s-fill.svg)';
    } else {
        listaBtnTab.style.display = 'block'; // Mostrar el elemento
        btnAcordeonTab.style.backgroundImage = 'url(/public/css/componentes/tab/imagenes/arrow-up-s-fill.svg)';

    }
    estadoVisible = !estadoVisible; // Alternar el estado
});