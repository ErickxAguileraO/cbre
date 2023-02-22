var start = 6; //establece con cuántos objetos se inicializará, y dará paso posteriormente a cuántos objetos se saltará (skip)
var take = 6; //establece cuántos objetos se obtendrán con cada nueva petición
var noticias = []; //array para almacenar los objetos
var stop = false; //detiente las peticiones al cambiar su estado a true
var isLoading = false; //soluciona error al hacer scroll spam
const noticiasContainer = document.getElementById("lista-noticias"); //contenedor principal para imprimir los elementos

document.addEventListener("DOMContentLoaded", async function () {
    await getInitialNoticias();
    printNoticias();
    await getNextNoticias();
});

async function getInitialNoticias() {
    const response = await fetch(`noticias/get/list?skip=${0}&take=${start}`);
    const data = await response.json();
    noticias = data.noticias;
}

async function getNextNoticias() {
    window.onscroll = () => {
      let bottomOfnoticiasContainer = window.innerHeight + window.pageYOffset >= noticiasContainer.offsetTop + noticiasContainer.offsetHeight;
      if (bottomOfnoticiasContainer && !stop && !isLoading) {
            isLoadingSniper(true);
          setTimeout(async () => {
            const response = await fetch(`noticias/get/list?skip=${start}&take=${take}`);
            const data = await response.json();
            noticias.push(...data.noticias);
            start = start + take;
            if (data.noticias.length === 0) {
              stop = true;
            }
            isLoadingSniper(false);
            printNoticias();
          }, Math.floor(Math.random() * (1100 - 300 + 1) + 300))
      }
    }
  }

function printNoticias() {
    while (noticiasContainer.firstChild) {
        noticiasContainer.removeChild(noticiasContainer.firstChild);
    }
    noticias.forEach(function (noticia, i) {
    const noticiaHTML =  `
    <div  class="noticia-home-n">
        <a href="noticias/${noticia.not_id}-${noticia.not_titulo.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "").replace(/[^\w ]+/g,'').replace(/ +/g,'-')
    }">
            <div class="">
            <img src="${noticia.urlImagen}" class="imagen-noticias" alt="">
            </div>
            <div class="contenido-noticia-n">
                <div class="date-noticia">
                    <img src="public/web/imagenes/i-calendario.svg" alt="">
                    <p>Publicado el ${noticia.created_at}</p>
                </div>
                <h2>${noticia.not_titulo}</h2>
                <a href="noticias/${noticia.not_id}-${noticia.not_titulo.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "").replace(/[^\w ]+/g,'').replace(/ +/g,'-')
            }" class="ver-mas">
                    <img src="public/web/imagenes/i-linea.svg" alt="">
                    <p>Ver noticia</p>
                </a>
            </div>
        </a>
    </div>
    `;
    noticiasContainer.insertAdjacentHTML('beforeend', noticiaHTML);
});
}

function isLoadingSniper(status){
    isLoading = status;
    document.getElementById("spinner").style.display = isLoading ? "block" : "none";
}

