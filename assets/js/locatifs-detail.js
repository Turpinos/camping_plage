const mainLocatifDetail = document.querySelector('.main-locatifs-details');
const imgCarroussel = document.querySelectorAll('.informations-principales .img');
const selectCarroussel = document.querySelectorAll('.select-container .pastille-select');

if( mainLocatifDetail != undefined){

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

}