const mainAdminDetail = document.querySelector('.main-admin-loc');

if(mainAdminDetail != undefined){

const pings = document.querySelectorAll('.map-container .ping');
//Boutons de modification..
const updateButtonLoc = document.querySelector('.modifier-loc');
const updateButtonTarifs = document.querySelector('.modifier-tarifs');
const updateButtonVignette = document.querySelector('.add-vignette');
const updateButtonPings = document.querySelectorAll('.update-ping');

//Bouton ajout..
const addButtonImg = document.querySelector('.add-img');
const addButtonInventaire = document.querySelector('.add-pdf');

//Bouton suppr..
const delButtonImg = document.querySelectorAll('.suppr-img');
const delButtonInventaire = document.querySelectorAll('.suppr-pdf');

//Boutons annulation form..
const annulFormLoc = document.querySelector('.div-form-locatifs form .button .annuler button');
const annulFormTarifs = document.querySelector('.div-form-tarifs form .button .annuler button');
const annulFormImages = document.querySelector('.div-form-images form .button .annuler button');
const annulFormDelImages = document.querySelector('.div-form-delImages form .button .annuler button')
const annulFormVignettes = document.querySelector('.div-form-vignettes form .button .annuler button');
const annulFormInventaires = document.querySelector('.div-form-inventaires form .button .annuler button');
const annulFormDelInventaires = document.querySelector('.div-form-delInventaires form .button .annuler button')
const annulFormCoordonnees = document.querySelector('.div-form-coordonnees form .button .annuler button');

const backgroundForm = document.querySelector('.background-form');

//Les formulaires..
const formLoc = document.querySelector('.div-form-locatifs');
const formTarifs = document.querySelector('.div-form-tarifs');
const formImg = document.querySelector('.div-form-images');
const formDelImg = document.querySelector('.div-form-delImages');
const formVignettes = document.querySelector('.div-form-vignettes');
const formInventaire = document.querySelector('.div-form-inventaires');
const formDelInventaires = document.querySelector('.div-form-delInventaires');
const formCoordonnes = document.querySelector('.div-form-coordonnees');

//Insertion fichiers..
const inputImg = document.querySelector('#form_images_img_url');
const inputVignette = document.querySelector('#form_vignette_img_url');
const inputPdf = document.querySelector('#form_inventaire_pdf_url');

//Affichage par défaut des pings
for (const ping of pings ) {
    ping.classList.remove('hidden');
}

//Afficher les formulaires par def si erreurs est détectée..
//tester si besoins de undefined ou non et le retirer de la page admin.js
if(document.querySelector('.div-form-locatifs form ul')){

    backgroundForm.classList.remove('hidden-form');
    formLoc.classList.remove('hidden-form');

}else if(document.querySelector('.div-form-tarifs form ul')){

    backgroundForm.classList.remove('hidden-form');
    formTarifs.classList.remove('hidden-form');

}else if(document.querySelector('.div-form-images form ul')){
    
    backgroundForm.classList.remove('hidden-form');
    formImg.classList.remove('hidden-form');

}else if(document.querySelector('.div-form-delImages form ul')){
    
    backgroundForm.classList.remove('hidden-form');
    formDelImg.classList.remove('hidden-form');

}else if(document.querySelector('.div-form-vignettes form ul')){
    
    backgroundForm.classList.remove('hidden-form');
    formVignettes.classList.remove('hidden-form');

}else if(document.querySelector('.div-form-inventaires form ul')){
    
    backgroundForm.classList.remove('hidden-form');
    formInventaire.classList.remove('hidden-form');

}else if(document.querySelector('.div-form-delInventaires form ul')){

    backgroundForm.classList.remove('hidden-form');
    formDelInventaires.classList.remove('hidden-form');

}else if(document.querySelector('.div-form-coordonnees form ul')){

    backgroundForm.classList.remove('hidden-form');
    formCoordonnes.classList.remove('hidden-form');

}

//Affichage des formulaires..
updateButtonLoc.addEventListener('click', function(e){
    document.body.style.overflow = 'hidden';

    backgroundForm.classList.remove('hidden-form');
    formLoc.classList.remove('hidden-form');

    //Attribution des valeurs..
    document.querySelector('.div-form-locatifs #form_locatifs_libelle').value = document.querySelector('.locations .name').innerText;
    document.querySelector('.div-form-locatifs #form_locatifs_description').value = document.querySelector('.locations .desc').innerText == 'null' ? '' : document.querySelector('.locations .desc').innerText;
    document.querySelector('.div-form-locatifs #form_locatifs_capacite').value = document.querySelector('.locations .capa').innerText == 'null' ? '' : document.querySelector('.locations .capa').innerText;
    document.querySelector('.div-form-locatifs #form_locatifs_superficie').value = document.querySelector('.locations .super').innerText == 'null' ? '' : document.querySelector('.locations .super').innerText;

    if(document.querySelector('.locations .pmr-acces').innerText == 'Oui'){
        document.querySelector('.div-form-locatifs #form_locatifs_pmr_type_0').checked = true;
    }else if(document.querySelector('.locations .pmr-acces').innerText == 'Non'){
        document.querySelector('.div-form-locatifs #form_locatifs_pmr_type_1').checked = true;
    }

    if(document.querySelector('.locations .ouv-hiver').innerText == 'Oui'){
        document.querySelector('.div-form-locatifs #form_locatifs_hiver_type_0').checked = true;
    }else if(document.querySelector('.locations .ouv-hiver').innerText == 'Non'){
        document.querySelector('.div-form-locatifs #form_locatifs_hiver_type_1').checked = true;
    }
    
    document.querySelector('.div-form-locatifs #form_locatifs_id').value = e.target.dataset.id;

});

updateButtonTarifs.addEventListener('click', function(e){
    document.body.style.overflow = 'hidden';

    backgroundForm.classList.remove('hidden-form');
    formTarifs.classList.remove('hidden-form');

    //Attribution des valeurs..
    const rowForm = document.querySelectorAll('.div-form-tarifs form div');
    let i = 0;
    for (const cell of document.querySelectorAll('.tarifs .table-info')) {

        if(!cell.classList.contains('dej')){

            if(cell.innerText != 'null'){
                rowForm[i].children[1].value = cell.innerText
            }

        }else{

            if(cell.innerText == 'Oui'){
                rowForm[i].children[1].children['form_tarifs_choice_type_0'].checked = true;
            }else if(cell.innerText == 'Non'){
                rowForm[i].children[1].children['form_tarifs_choice_type_1'].checked = true;
            }
        }

        i++;
    }

    document.querySelector('.div-form-tarifs #form_tarifs_id').value = e.target.dataset.id;

});

addButtonImg.addEventListener('click', function(e) {
    
    backgroundForm.classList.remove('hidden-form');
    formImg.classList.remove('hidden-form');

    document.querySelector('.div-form-images #form_images_id').value = e.target.dataset.id;

})

inputImg.addEventListener('change', function(e){

    const divImg = document.querySelector('.div-form-images form .preview-img-form');

    if(document.querySelector('.div-form-images form .preview-img-form img')){
        divImg.removeChild(document.querySelector('.div-form-images form .preview-img-form img'));
    }

    const img = document.createElement('img');
    img.setAttribute('src', '');
    img.setAttribute('alt', 'Prévisualisation');

    const file = e.target.files[0]

    const reader = new FileReader();
    reader.onloadend = function() {

        img.src = reader.result;
        divImg.appendChild(img);

    }

    if(file){
        if(file.type == 'image/jpeg'){
            reader.readAsDataURL(file);
        }else{
            e.target.value = '';
            divImg.innerHTML = '';
        }
    }

});

updateButtonVignette.addEventListener('click', function(e){

    backgroundForm.classList.remove('hidden-form');
    formVignettes.classList.remove('hidden-form');

    document.querySelector('.div-form-vignettes #form_vignette_id').value = e.target.dataset.id;

});

inputVignette.addEventListener('change', function(e){


    const divImg = document.querySelector('.div-form-vignettes form .preview-img-form');

    const overlay = document.querySelector('.div-form-vignettes form .preview-img-form .overlay');

    if(document.querySelector('.div-form-vignettes form .preview-img-form img')){
        divImg.removeChild(document.querySelector('.div-form-vignettes form .preview-img-form img'));
    }

    const img = document.createElement('img');
    img.setAttribute('src', '');
    img.setAttribute('alt', 'Prévisualisation');

    const file = e.target.files[0]
    

    const reader = new FileReader();
    reader.onloadend = function() {

        img.src = reader.result;
        divImg.insertBefore(img, overlay);

        //Configuration clippath pour simuler le rendu final..
        const playImg = document.querySelector('.div-form-vignettes form .preview-img-form img');
        const imgWidth = playImg.clientWidth;
        const imgHeigth = playImg.clientHeight;
        const imgX = (imgWidth - imgHeigth) / 2;

        overlay.style.width = `${imgWidth}px`;
        overlay.style.height = `${imgHeigth}px`;
        overlay.style.clipPath = `polygon(0px 0px, 0px ${imgHeigth}px, ${imgX}px ${imgHeigth}px, ${imgX}px 0px, ${imgX + imgHeigth}px 0px, ${imgX + imgHeigth}px ${imgHeigth}px, 0px ${imgHeigth}px, 0px ${imgHeigth}px, ${imgWidth}px ${imgHeigth}px, ${imgWidth}px 0px)`;
        
    }

    if(file){
        if(file.type == 'image/jpeg'){
            reader.readAsDataURL(file);
        }else{
            e.target.value = '';
            divImg.innerHTML = '';
        }
    }

});

addButtonInventaire.addEventListener('click', function(e){

    backgroundForm.classList.remove('hidden-form');
    formInventaire.classList.remove('hidden-form');

    document.querySelector('.div-form-inventaires #form_inventaire_id').value = e.target.dataset.id;

});

inputPdf.addEventListener('change', function(e){
    const file = e.target.files[0]

    if(file){
        if(file.type != 'application/pdf'){
            e.target.value = '';
        }
    }
});

if(updateButtonPings.length != 0){

    for (const update of updateButtonPings) {
    
        update.addEventListener('click', function(e){
    
            backgroundForm.classList.remove('hidden-form');
            formCoordonnes.classList.remove('hidden-form');

            const rowEmplacement = e.target.parentNode;
            const setPing = document.querySelector('.map-set .ping');

            const inputEmplacement = formCoordonnes.children[0].children[1].children[1];
            const inputPosition = formCoordonnes.children[0].children[2].children[1];
            inputPosition.addEventListener('click', function(e){
                e.preventDefault();
            });

            inputPosition.addEventListener('keydown', function(e){
                e.preventDefault();
            });
            
            inputEmplacement.value = rowEmplacement.children[0].innerText;
            inputPosition.value = rowEmplacement.children[0].dataset.position;
            setPing.setAttribute('style', rowEmplacement.children[0].dataset.position);

            document.querySelector('.map-set img').addEventListener('click', function(e){
                //Calcule en % des coodonnées sur la carte..
                const calcY = Math.round(e.offsetY*100/e.target.clientHeight);
                const calcX = Math.round(e.offsetX*100/e.target.clientWidth);

                //Insertion des données dans les champs correspondants..
                inputPosition.value = `top:${calcY}%; left:${calcX}%;`
                setPing.setAttribute('style', `top:${calcY}%; left:${calcX}%;`);

            });

            document.querySelector('.div-form-coordonnees #form_coordonnees_id').value = e.target.dataset.id;
    
        });
    }
}

//Formulaire de suppression..
for (const suppr of delButtonImg) {
    
    suppr.addEventListener('click', function(e){

        backgroundForm.classList.remove('hidden-form');
        formDelImg.classList.remove('hidden-form');

        const rowImg = e.target.parentNode;

        document.querySelector('.div-form-delImages form .del-libelle').innerText = rowImg.children[0].innerText;
        document.querySelector('.div-form-delImages form .preview-img-form').innerHtml = rowImg.children[1].innerHTML;

        document.querySelector('.div-form-delImages form #form_delImages_id').value = e.target.dataset.id;
    });
}

for (const suppr of delButtonInventaire) {
    
    suppr.addEventListener('click', function(e){

        backgroundForm.classList.remove('hidden-form');
        formDelInventaires.classList.remove('hidden-form');

        const rowPdf = e.target.parentNode;

        document.querySelector('.div-form-delInventaires form .del-libelle').innerText = rowPdf.children[0].innerText;

        document.querySelector('.div-form-delInventaires form #form_delInventaire_id').value = e.target.dataset.id;
    });
}

//Fermeture formulaire..
annulFormLoc.addEventListener('click', function(){
    document.body.style.overflow = 'scroll';

    backgroundForm.classList.add('hidden-form');
    formLoc.classList.add('hidden-form');
    
});

annulFormTarifs.addEventListener('click', function(){
    document.body.style.overflow = 'scroll';

    backgroundForm.classList.add('hidden-form');
    formTarifs.classList.add('hidden-form');

});

annulFormImages.addEventListener('click', function(){

    backgroundForm.classList.add('hidden-form');
    formImg.classList.add('hidden-form');

    inputImg.value = '';
    document.querySelector('.div-form-images form .preview-img-form').innerHTML = '';

});

annulFormVignettes.addEventListener('click', function(){

    backgroundForm.classList.add('hidden-form');
    formVignettes.classList.add('hidden-form');

    inputVignette.value = '';
    document.querySelector('.div-form-vignettes form .preview-img-form').removeChild(document.querySelector('.div-form-vignettes form .preview-img-form img'));

    document.querySelector('.div-form-vignettes form .preview-img-form div').style.height = '0px';

});

annulFormInventaires.addEventListener('click', function(){

    backgroundForm.classList.add('hidden-form');
    formInventaire.classList.add('hidden-form');

    inputPdf.value = '';

});

if(annulFormCoordonnees != undefined){

    annulFormCoordonnees.addEventListener('click', function(){

        backgroundForm.classList.add('hidden-form');
        formCoordonnes.classList.add('hidden-form');
    
    });
}

annulFormDelImages.addEventListener('click', function(){
    backgroundForm.classList.add('hidden-form');
    formDelImg.classList.add('hidden-form');
});

annulFormDelInventaires.addEventListener('click', function(){
    backgroundForm.classList.add('hidden-form');
    formDelInventaires.classList.add('hidden-form');
});



}