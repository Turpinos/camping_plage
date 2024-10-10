const mainLocatifDetail = document.querySelector('.main-locatifs-details');

if( mainLocatifDetail != undefined){

const imgCarroussel = document.querySelectorAll('.informations-principales .img');
const selectCarroussel = document.querySelectorAll('.select-container .pastille-select');
const openerMap = document.querySelector('.lien-carte');
const pings = document.querySelectorAll('.ping');
const backgroundMap = document.getElementById('background-map');
const closeMap = document.querySelector('#background-map .close');

for (const select of selectCarroussel) {
    select.addEventListener('click', function(){
        if(select.getAttribute('class') != 'pastille-select active'){
            for (const sel of selectCarroussel) {
                if(sel.getAttribute('class') == 'pastille-select active'){
                    sel.classList.remove('active');
                }
            }
            select.classList.add('active');

            for (const img of imgCarroussel) {
                if(img.getAttribute('class') == 'img'){
                    img.classList.add('hidden');
                }
            }
            for (const img of imgCarroussel) {
                if(img.dataset.id == select.dataset.id){
                    img.classList.remove('hidden');
                }
            }
        }

    });
}

openerMap.addEventListener('click', function(){
    document.body.style.overflow = 'hidden';

    backgroundMap.classList.add('background-map');
    backgroundMap.classList.remove('hidden');
    for(const ping of pings){
        ping.classList.remove('hidden');
    }
});

closeMap.addEventListener('click', function(){
    //reactiver le scroll..
    document.body.style.overflow = 'auto';

    backgroundMap.classList.add('hidden');
    backgroundMap.classList.remove('background-map');
    for (const ping of pings) {
        ping.setAttribute('class', 'ping hidden');
    }
});

}