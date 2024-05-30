const mapInteractive = document.querySelector('.map-interactive');
const mapContainer = document.querySelector('.map-container');

mapContainer.addEventListener('mousemove', function(e){
    let y = e.offsetY;
    let x = e.offsetX;
    let width = mapContainer.clientWidth;
    let height = mapContainer.clientHeight;
    console.log('Y:' + Math.round(y*100/height) + '-' + ' X:' + Math.round(x*100/width));
});