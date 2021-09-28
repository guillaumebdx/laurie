let screenWidth = window.innerWidth;
let mapContainer = document.getElementById('map-container');
if (screenWidth < 664) {
    alert(screenWidth);
    mapContainer.style.transform = 'scale(' + screenWidth/1000 + ')';
}