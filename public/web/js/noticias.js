var start = 1; //establece con cuántos objetos se inicializará
var take = 1; //establece cuántos objetos se obtendrán con cada nueva petición
var noticias = []; //array para almacenar los objetos
let stop = false; //detiente las peticiones al cambiar su estado a true
let wait = false; //soluciona error al hacer scroll spam
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
      let bottomOfWindow = document.documentElement.scrollTop + window.innerHeight === document.documentElement.offsetHeight;
      if (bottomOfWindow) {
        if (!stop && !wait) {
            isLoading(true);
          setTimeout(async () => {
            const response = await fetch(`noticias/get/list?skip=${start}&take=${take}`);
            const data = await response.json();
            noticias.push(...data.noticias);
            start++;
            if (data.noticias.length === 0) {
              stop = true;
            }
            printNoticias();
            isLoading(false);
          }, Math.floor(Math.random() * (800 - 300 + 1) + 300))
        }
      }
    }
  }

function printNoticias() {
    noticiasContainer.innerHTML = "";
    noticias.forEach(function (noticia, i) {
    noticiasContainer.innerHTML +=  `
    <div  class="noticia-home-n">
        <a href="#">
            <div class="">
            <img src="${noticia.urlImagen}" style="width: 100%;height: 250px;" alt="">
            </div>
            <div class="contenido-noticia-n">
                <div class="date-noticia">
                    <img src="public/web/imagenes/i-calendario.svg" alt="">
                    <p>Publicado el ${noticia.created_at}</p>
                </div>
                <h2>${noticia.not_titulo}</h2>
                <a href="/noticias-detalle" class="ver-mas">
                    <img src="public/web/imagenes/i-linea.svg" alt="">
                    <p>Ver noticia</p>
                </a>
            </div>
        </a>
    </div>
    `;
});
}

function isLoading(isLoading){
    if(isLoading){
        wait = true;
        document.getElementById("spinner").style.display = "block";
    }else{
        wait = false;
        document.getElementById("spinner").style.display = "none";
    }
}

