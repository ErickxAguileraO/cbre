var start = 6; //establece con cuántos objetos se inicializará, y dará paso posteriormente a cuántos objetos se saltará (skip)
var take = 6; //establece cuántos objetos se obtendrán con cada nueva petición
var edificios = []; //array para almacenar los objetos
var stop = false; //detiente las peticiones al cambiar su estado a true
var isLoading = false; //soluciona error al hacer scroll spam
var submercado = null;
const edificiosContainer = document.getElementById("edificios-busqueda"); //contenedor principal para imprimir los elementos

document.addEventListener("DOMContentLoaded", async function () {
    await getInitialEdificios();
    await getNextEdificios();
});

async function getInitialEdificios() {
    document.getElementById("total-edificios").innerText = 'Buscando...';
    isLoadingSpinner(true);
    setTimeout(async () => {
        const response = await fetch(`edificios-oficinas/get/list?skip=${0}&take=${take}&submercado=${submercado}`);
        const data = await response.json();
        edificios = data.edificios;
        isLoadingSpinner(false);
        document.getElementById("total-edificios").innerText = data.total + ' ' + 'edificio(s) encontrados';
        printEdificios();
      }, Math.floor(Math.random() * (1100 - 300 + 1) + 300))
}

async function getNextEdificios() {
    window.onscroll = () => {
      let bottomOfedificiosContainer = window.innerHeight + window.pageYOffset >= edificiosContainer.offsetTop + edificiosContainer.offsetHeight;
      if (bottomOfedificiosContainer && !stop && !isLoading) {
        isLoadingSpinner(true);
          setTimeout(async () => {
            const response = await fetch(`edificios-oficinas/get/list?skip=${start}&take=${take}&submercado=${submercado}`);
            const data = await response.json();
            edificios.push(...data.edificios);
            start = start + take;
            if (data.edificios.length === 0) {
              stop = true;
            }
            isLoadingSpinner(false);
            printEdificios();
          }, Math.floor(Math.random() * (1100 - 300 + 1) + 300))
      }
    }
  }

function removeContainerElements(){
    while (edificiosContainer.firstChild) {
        edificiosContainer.removeChild(edificiosContainer.firstChild);
    }
}

function printEdificios() {
    removeContainerElements();
    edificios.forEach(function (edificio, i) {
    const edificioHTML = `
    <div class="edificios-n">
        <a href="edificios-oficinas/${edificio.edi_id}-${edificio.edi_nombre.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "").replace(/[^\w ]+/g,'').replace(/ +/g,'-')
}">
        <div class="">
            <img src="${edificio.urlImagenListado}" class="imagen-edificios" alt="">
        </div>
            <div class="txt-edificio">
                <h2 style="color:black">${edificio.edi_nombre}</h2>
                    <div class="ubi-green">
                        <img src="public/web/imagenes/i-gps-green.svg" alt="">
                        <p>${edificio.edi_direccion}</p>
                    </div>
                        <div class="lista-detalle-edificio-descripcion">
                        <p>${htmlDecode(edificio.edi_descripcion)}</p>
                        </div>
                    <a href="edificios-oficinas/${edificio.edi_id}-${edificio.edi_nombre.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "").replace(/[^\w ]+/g,'').replace(/ +/g,'-')
                }" class="ver-mas">
                        <img src="public/web/imagenes/i-linea.svg" alt="">
                        <p>Ver edificio</p>
                    </a>
            </div>
        </a>
    </div>
`;
    edificiosContainer.insertAdjacentHTML('beforeend', edificioHTML);
});
}

function htmlDecode(input) {
    const doc = new DOMParser().parseFromString(input, "text/html");
    return doc.documentElement.textContent;
}

function isLoadingSpinner(status){
    isLoading = status;
    document.getElementById("spinner").style.display = isLoading ? "block" : "none";
}

$('#submercado').change(async function() {
    submercado = document.getElementById("submercado").value;
    removeContainerElements();
    start = 6;
    stop = false;
    await getInitialEdificios();
});
