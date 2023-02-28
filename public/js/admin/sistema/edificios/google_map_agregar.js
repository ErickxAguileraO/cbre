let map;
let marker;
const coordenadasChile = { lat: -35.675147, lng: -71.542969 };
let autocompletado;
const mapInput = document.getElementById('autocompletadoMap');
let direccion;

function initMap() {
    // Objeto mapa
    map = new google.maps.Map(document.getElementById("map"), {
        center: coordenadasChile,
        zoom: 8,
    });

    // El marcador, posicionado en Chile
    marker = new google.maps.Marker({
        position: coordenadasChile,
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
