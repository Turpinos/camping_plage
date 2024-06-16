const mainLocatifs = document.getElementById('locatifs');

if( mainLocatifs != undefined){

const ulCategorie = document.getElementById('ul-select');
const selectCategorie = document.querySelectorAll('#ul-select li input');
const pCategorie = document.querySelector('.select-categories p');
const buttonCategorie = document.querySelector('#ul-select li button');
const listArticle = document.querySelectorAll('.liste-article article');
let filteredListArticle = [];
const containerArticles = document.querySelector('.liste-article');
const backgroundMap = document.getElementById('background-map');
const closeMap = document.querySelector('#background-map .close');
const openersMap = document.querySelectorAll('.libelle-emplacement img');
const pings = document.querySelectorAll('.ping');
let isOpenedCategorie = false;


pCategorie.addEventListener('click', function(){

    if(!isOpenedCategorie){
        ulCategorie.classList.add('ul-select');
        ulCategorie.classList.remove('hidden');
        isOpenedCategorie = true;
    }else{
        ulCategorie.classList.add('hidden');
        ulCategorie.classList.remove('ul-select');
        isOpenedCategorie = false;
    }
    
});

closeMap.addEventListener('click', function(){
    //reactiver le scroll..
    document.body.style.overflow = 'auto';

    backgroundMap.classList.add('hidden');
    backgroundMap.classList.remove('background-map');
    for (const ping of pings) {

        if(ping.getAttribute('class') != 'ping hidden'){
            ping.setAttribute('class', 'ping hidden');
        }
    }
});

for( const opener of openersMap){
    opener.addEventListener('click', function(){
        //empecher le scroll..
        document.body.style.overflow = 'hidden';

        backgroundMap.classList.add('background-map');
        backgroundMap.classList.remove('hidden');
        for(const ping of pings){
            if(opener.dataset.id == ping.dataset.locatif){
                ping.classList.remove('hidden');
            }
        }
    });
}

buttonCategorie.addEventListener('click', function(){
    ulCategorie.classList.add('hidden');
    ulCategorie.classList.remove('ul-select');
    isOpenedCategorie = false;

    filteredListArticle = [];
    for (const select of selectCategorie) {
        if(select.checked){
            for (const article of listArticle) {
                if(article.dataset.cate == select.dataset.cate){
                    filteredListArticle.push(article);
                    
                }
            }
        }
    }
    containerArticles.innerHTML = '';
    if(filteredListArticle.length != 0){
        for (const filteredArticle of filteredListArticle) {
            containerArticles.append(filteredArticle);
        }
    }else{
        for (const article of listArticle) {
            containerArticles.append(article);
        }
    }
});

}
