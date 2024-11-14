const mainMedia = document.getElementById('media');

if(mainMedia != undefined){
//les

const backgroundImg = document.querySelector('#background-img');
const viewImg = document.querySelector('#background-img .view-img');
const closeImg = document.querySelector('#background-img .close');
const listImg = document.querySelectorAll('section img');


for (const img of listImg) {
    
    img.addEventListener('click', function(e){
        //désactiver le scroll..
        document.body.style.overflow = 'hidden';

        viewImg.setAttribute('src', e.target.getAttribute('src'));
        viewImg.setAttribute('alt', e.target.getAttribute('alt'));
        backgroundImg.classList.add('background-img');
        backgroundImg.classList.remove('hidden');
    })
};

closeImg.addEventListener('click', function(){
    //reactiver le scroll..
    document.body.style.overflow = 'auto';

    viewImg.setAttribute('src', '');
    viewImg.setAttribute('alt', '');
    backgroundImg.classList.add('hidden');
    backgroundImg.classList.remove('background-img');
});

}