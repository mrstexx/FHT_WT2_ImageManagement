// center of the map
var center = [48.20849, 16.37208];

// Create the map
var map = L.map('map').setView(center, 13);

// Set up the OSM layer
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png?{foo}', {
    foo: 'bar',
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>'
}).addTo(map);

// add a marker in the given location
// L.marker(center).addTo(map);


target = document.getElementById("map");
target.ondragover = function (e) {
    e.preventDefault();
    e.dataTransfer.dropEffect = "move"
};

target.ondrop = function (e) {
    e.preventDefault();
    imagePath = e.dataTransfer.getData("text/plain");
    coordinates = map.containerPointToLatLng(L.point([e.clientX, e.clientY]))
    L.marker(coordinates, {
        icon: L.icon({iconUrl: imagePath}),
        draggable: true
    }).addTo(map)
};