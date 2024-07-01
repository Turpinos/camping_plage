const mainLocatifs = document.getElementById('locatifs');

if( mainLocatifs != undefined){

const ulCategorie = document.getElementById('ul-select');
const selectCategorie = document.querySelectorAll('#ul-select li input');
const pCategorie = document.querySelector('.select-categories p');
const buttonCategorie = document.querySelector('#ul-select li button');
const listArticle = document.querySelectorAll('.liste-article article');
let filteredListArticle = [];
let preSortedListArticle = [];
let sortedListArticle = [];
const selectSort = document.querySelector('.select-tri');
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

    containerArticles.animate(
        [
        {opacity: '1'},
        {opacity: '0'}
        ],
        {
            duration:100,
            fill: 'forwards'
        }
    )

    setTimeout(()=>{
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
        containerArticles.animate(
            [
            {opacity: '0'},
            {opacity: '1'}
            ],
            {
                duration:100,
                fill: 'forwards'
            }
        )
    },200);

    document.querySelector('.select-tri [value="ordre alphabetique"]').selected = true;

});



selectSort.addEventListener('change', function(e){
    preSortedListArticle = document.querySelectorAll('.liste-article article');
    sortedListArticle = [];
    let newArray = [];

    for (const article of preSortedListArticle) {
        sortedListArticle.push(article);
    }

    containerArticles.animate(
        [
        {opacity: '1'},
        {opacity: '0'}
        ],
        {
            duration:100,
            fill: 'forwards'
        }
    )

    setTimeout(()=>{
        if(e.target.value == 'ordre alphabetique'){
            newArray = sortedListArticle.sort((a, b) => a.dataset.slug.localeCompare(b.dataset.slug))
            containerArticles.innerHTML = '';
            for (const article of newArray) {
                containerArticles.append(article);
            }
        }else if(e.target.value == 'capacite croissante'){
            newArray = sortedListArticle.sort((a, b) => a.dataset.capacite[0] - b.dataset.capacite[0])
            containerArticles.innerHTML = '';
            for (const article of newArray) {
                containerArticles.append(article);
            }
        }else if(e.target.value == 'capacite decroissante'){
            newArray = sortedListArticle.sort((a, b) => b.dataset.capacite[0] - a.dataset.capacite[0])
            containerArticles.innerHTML = '';
            for (const article of newArray) {
                containerArticles.append(article);
            }
        }

        containerArticles.animate(
            [
            {opacity: '0'},
            {opacity: '1'}
            ],
            {
                duration:100,
                fill: 'forwards'
            }
        )

    }, 200);
    
});

}
