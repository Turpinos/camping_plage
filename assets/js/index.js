const mainIndex =  document.getElementById('index');

if(mainIndex != undefined){

const mapInteractive = document.querySelector('.map-interactive');
const mapContainer = document.querySelector('.map-container');
const inputContainer = document.querySelectorAll('.input-container');
const pings = document.querySelectorAll('.ping');
let isActiveSelect = false;

for(const input of inputContainer){
    input.addEventListener('click', function(){

        if(!isActiveSelect){
            input.classList.add('check');
            for (const ping of pings) {
                if(ping.dataset.id == input.dataset.id){
                    ping.classList.remove('hidden');
                }
            }
            isActiveSelect = true;
        }else{
            input.classList.remove('check');
            for (const ping of pings) {
                if(ping.dataset.id == input.dataset.id){
                    ping.classList.add('hidden');
                }
            }
            isActiveSelect = false;
        }

    });
}


mapContainer.addEventListener('mousemove', function(e){
    let y = e.offsetY;
    let x = e.offsetX;
    let width = mapContainer.clientWidth;
    let height = mapContainer.clientHeight;
    console.log('Y:' + Math.round(y*100/height) + '-' + ' X:' + Math.round(x*100/width));
});

}