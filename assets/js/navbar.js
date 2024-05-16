const navbarContainer = document.querySelector('.container');
const banner = document.querySelector('.banner');
const divChoiceLang = document.querySelector('.choiceLang');
const choiceLang = document.querySelectorAll('.choiceLang img');
const lang = document.querySelector('.lang');
const hamburger = document.querySelector('.hamburger');
const closed = document.querySelector('.close');
const popUp = document.querySelector('#nav');
const background = document.querySelector('#background');

let valueHeightNav = navbarContainer.clientHeight;
let initPosNav =  navbarContainer.offsetTop;
let initStyleNav = navbarContainer.style.top;
let width = lang.clientWidth;

let initPosScreen = window.scrollY;
let initWidthScreen = window.screen.availWidth;

let isActive;

//Event scroll, gestion position & animation navbar;
window.addEventListener('scroll', function(){

    //Gestion du redimentionnement pour la position de la navbar;
    let lastWidthScreen = window.screen.availWidth;
    if(initWidthScreen != lastWidthScreen){
        width = lang.clientWidth;
        valueHeightNav = navbarContainer.clientHeight;
        initPosNav = banner.clientHeight - (valueHeightNav / 2);
        initStyleNav = `-${valueHeightNav / 2}px`
    }

    let posScreen = window.scrollY;

    let scroll;

    if(initPosScreen < posScreen){
        scroll = 'desc';
        initPosScreen = posScreen;
    }else if(initPosScreen > posScreen){
        scroll = 'asc';
        initPosScreen = posScreen;
    }


    if((initPosNav + valueHeightNav <= posScreen) && scroll == 'desc' && isActive != true){
        navbarContainer.style.position = 'fixed';
        navbarContainer.style.top = '0px';
        navbarContainer.classList.add('anim');
        
        if(window.screen.availWidth >= 860){
            banner.style.marginBottom = `${valueHeightNav}px`;
        }else if(window.screen.availWidth < 860){
            banner.style.marginBottom = `${0}px`;
        }
        isActive = true;
        console.log('true');

    }else if((initPosNav >= posScreen) && scroll == 'asc' && isActive != false){
        navbarContainer.style.position = 'relative';
        navbarContainer.style.top = initStyleNav;
        banner.style.marginBottom = '0px';
        navbarContainer.classList.remove('anim');
        isActive = false;
        console.log('false');

    }

});

let isOpen = false
lang.addEventListener('click', function(e){

    if(isOpen == false){
        divChoiceLang.style.width = `${width+6}px`;
        divChoiceLang.style.display = 'flex';

        divChoiceLang.animate([
            {opacity: '0'},
            {opacity: '1'}
        ],
        {
            duration: 100
        })

        isOpen = true;
    }else{
        divChoiceLang.style.display = 'none';
        isOpen = false;
    }
     
     
});

for (const img of choiceLang) {
    img.addEventListener('click', function(){

    });
}

//Ouverture menu;
hamburger.addEventListener('click', function(){
    background.classList.remove('disabled');
    popUp.classList.remove('disabled');
    background.classList.add('back');
    popUp.classList.add('pop-up');

    navbarContainer.animate(
        [
            {transform: 'translateX(0%)'},
            {transform: 'translateX(-100%)'}
        ],
        {
            duration: 200,
            easing: 'ease-in-out',
        }
    )

    setTimeout(()=>{
        navbarContainer.style.display = 'none';
    }, 190);
});

//Fermeture menu;
closed.addEventListener('click', function(){
    
    background.animate(
        [
            {opacity: 1},
            {opacity: 0}
        ],
        {
            duration: 100
        }
    )

    setTimeout(()=>{
        background.classList.remove('back');
        popUp.classList.remove('pop-up');
        background.classList.add('disabled');
        popUp.classList.add('disabled');
    }, 80);

    navbarContainer.animate(
        [
            {transform: 'translateX(-100%)'},
            {transform: 'translateX(0%)'}
        ],
        {
            duration: 200,
            easing: 'ease-in-out',
        }
    )
    
    setTimeout(()=>{
        navbarContainer.style.display = 'flex';
    }, 10);
    
});
