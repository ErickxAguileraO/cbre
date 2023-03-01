let map;
let marker;
const mapDiv = document.getElementById("map");
const latitudEdificio = parseFloat(mapDiv.getAttribute('data-latitud'));
const longitudEdificio = parseFloat(mapDiv.getAttribute('data-longitud'));
const coordenadasInicio = { lat: latitudEdificio, lng: longitudEdificio };
let autocompletado;
const mapInput = document.getElementById('autocompletadoMap');
let direccion = document.getElementById('direccionRegistrada').getAttribute('data-direccion-registrada');

function initMap() {
    // Objeto mapa
    map = new google.maps.Map(document.getElementById("map"), {
        center: coordenadasInicio,
        zoom: 15,
    });

    // El marcador, posicionado en Chile
    marker = new google.maps.Marker({
        position: coordenadasInicio,
        map: map,
    });

    iniciarAutocompletado();
}

function iniciarAutocompletado() {
    autocompletado = new google.maps.places.Autocomplete(mapInput);
    autocompletado.addListener('place_changed', function () {
        const ubicacion = this.getPlace();
        map.setCenter(ubicacion.geometry.location);
        marker.setPosition(ubicacion.geometry.location);
        direccion = ubicacion.formatted_address;
    });
}

window.initMap = initMap;
