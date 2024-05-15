const navbarContainer = document.querySelector('.container');
const banner = document.querySelector('.banner');

let valueHeightNav = navbarContainer.clientHeight;
let initPosNav =  navbarContainer.offsetTop;
let initStyleNav = navbarContainer.style.top;

let initPosScreen = window.scrollY;
let initWidthScreen = window.screen.availWidth;

let isActive;

//Event scroll, gestion position & animation navbar;
window.addEventListener('scroll', function(){

    //Gestion du redimentionnement pour la position de la navbar;
    let lastWidthScreen = window.screen.availWidth;
    if(initWidthScreen != lastWidthScreen){
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


