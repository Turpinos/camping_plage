const mainAdmin = document.getElementById('main-admin');

if( mainAdmin != undefined ){

const backgroundForm = document.querySelector('.background-form');

//Liste de tous les formulaires..
const divFormSaisons = document.querySelector('.div-form-saisons');
const divFormOuvertures = document.querySelector('.div-form-ouvertures');
const divFormGallery = document.querySelector('.div-form-gallery');
const divFormInfo = document.querySelector('.div-form-info');
const divFormTarifs = document.querySelector('.div-form-tarifs');
const divFormAccesPmr = document.querySelector('.div-form-accesPmr');
const divFormDelGallery = document.querySelector('.div-form-delGallery');
const divFormDelAccesPmr = document.querySelector('.div-form-delAccesPmr');

//List des buttons d'annulations des formulaires..
const annulFormSaisons = document.querySelector('.div-form-saisons .annuler button');
const annulFormOuvertures = document.querySelector('.div-form-ouvertures .annuler button');
const annulFormGallery = document.querySelector('.div-form-gallery .annuler button');
const annulFormInfo = document.querySelector('.div-form-info .annuler button');
const annulFormTarifs = document.querySelector('.div-form-tarifs .annuler button');
const annulFormAccesPmr = document.querySelector('.div-form-accesPmr .annuler button');
const annulFormDelGallery = document.querySelector('.div-form-delGallery .annuler button');
const annulFormDelAccesPmr = document.querySelector('.div-form-delAccesPmr .annuler button');

//Boutons pour déclencher l'apparition des formulaires..
const updateButtonSaisons = document.querySelectorAll('.modifier-saisons');
const updateButtonOuvertures = document.querySelectorAll('.modifier-ouvertures');
const updateButtonInfo = document.querySelectorAll('.modifier-info');
const updateButtonTarifs = document.querySelectorAll('.modifier-tarifs');
const updateButtonAccesPmr = document.querySelectorAll('.modifier-acces');

const deleteButtonGallery = document.querySelectorAll('.suppr-img');
const deleteButtonAccesPmr = document.querySelectorAll('.suppr-acces');

const addButtonGallery = document.querySelector('.add-img');
const addButtonAccesPmr = document.querySelector('.add-acces');

//Champ type file pour la gallerie..
const inputFile = document.querySelector('#form_gallery_img_url');

//Ouvrir auto. si une erreur est détectée dans un form après tentative de sa transmission..  
if(document.querySelector('.div-form-saisons form ul') != undefined){

    backgroundForm.classList.remove('hidden');
    divFormSaisons.classList.remove('hidden');

}else if(document.querySelector('.div-form-ouvertures form ul') != undefined){

    backgroundForm.classList.remove('hidden');
    divFormOuvertures.classList.remove('hidden');

}else if(document.querySelector('.div-form-gallery form ul') != undefined){

    backgroundForm.classList.remove('hidden');
    divFormGallery.classList.remove('hidden');

}else if(document.querySelector('.div-form-info form ul') != undefined){

    backgroundForm.classList.remove('hidden');
    divFormInfo.classList.remove('hidden');

}else if(document.querySelector('.div-form-tarifs form ul') != undefined){

    backgroundForm.classList.remove('hidden');
    divFormTarifs.classList.remove('hidden');

}else if(document.querySelector('.div-form-accesPmr form ul') != undefined){

    backgroundForm.classList.remove('hidden');
    divFormAccesPmr.classList.remove('hidden');

}else if(document.querySelector('.div-form-delGallery form ul') != undefined){

    backgroundForm.classList.remove('hidden');
    divFormDelGallery.classList.remove('hidden');

}else if(document.querySelector('.div-form-delAccesPmr form ul') != undefined){

    backgroundForm.classList.remove('hidden');
    divFormDelAccesPmr.classList.remove('hidden');

}

//Déclenchement form saisons..
for (const update of updateButtonSaisons) {

    update.addEventListener('click', function(e){

        backgroundForm.classList.remove('hidden');
        divFormSaisons.classList.remove('hidden');

        const containerElements = e.target.parentNode;
        let listInfosElement = [];
        
        for (const element of containerElements.children) {

            if( !element.classList.contains('modifier')){

                let valueElement = element.innerText.replace('De: ', '');
                valueElement = valueElement.replace('A: ', '');
                listInfosElement.push(valueElement);
                
            }
        }

        const listInputs = document.querySelectorAll('.div-form-saisons form div input');

        let i = 0;
        for (const input of listInputs) {

            if(input.getAttribute('type') == 'date'){

                let date = listInfosElement[i].split('/');
                let day = date[0];
                let month = date[1];
                let year = date[2];

                input.value = `${year}-${month}-${day}`;
            }else{

                input.value = listInfosElement[i];

            }
            i++;
        }

        const inputId = document.querySelector('.div-form-saisons form #form_saisons_id');
        inputId.value = e.target.dataset.id;

    });
}

//Annulation form saisons..
annulFormSaisons.addEventListener('click', function(){

    const listInputs = document.querySelectorAll('.div-form-saisons form div input');

    for (const input of listInputs) {
        
        input.value = '';

    }

    backgroundForm.classList.add('hidden');
    divFormSaisons.classList.add('hidden');
});



//Déclenchement form ouvertures..
for (const update of updateButtonOuvertures) {

    update.addEventListener('click', function(e){

        backgroundForm.classList.remove('hidden');
        divFormOuvertures.classList.remove('hidden');

        const containerElements = e.target.parentNode;
        let listInfosElement = [];
        
        for (const element of containerElements.children) {

            if( !element.classList.contains('modifier')){

                listInfosElement.push(element);
                
            }
        }

        const libelleInput = document.querySelector('.div-form-ouvertures form div input');
        const radioInput = document.querySelectorAll('.div-form-ouvertures form div #form_ouvertures_choice_type input');

        libelleInput.value = listInfosElement[0].innerText;

        for (const input of radioInput) {

            if(input.getAttribute('value') == listInfosElement[1].dataset.bool){
                
                input.checked = true;
                
            }
        }

        const inputId = document.querySelector('.div-form-ouvertures form #form_ouvertures_id');
        inputId.value = e.target.dataset.id;

    });
}

//Annulation form ouvertures..
annulFormOuvertures.addEventListener('click', function(){

    const libelleInput = document.querySelector('.div-form-ouvertures form div input');
    const radioInput = document.querySelectorAll('.div-form-ouvertures form div #form_ouvertures_choice_type input');

    libelleInput.value = '';

    for (const input of radioInput) {
        
        input.checked = false;

    }

    backgroundForm.classList.add('hidden');
    divFormOuvertures.classList.add('hidden');
});

//Déclenchement form suppr image..
for (const suppr of deleteButtonGallery) {

    suppr.addEventListener('click', function(e){

        backgroundForm.classList.remove('hidden');
        divFormDelGallery.classList.remove('hidden');

        const containerElements = e.target.parentNode;
        let listInfosElement = [];
        
        for (const element of containerElements.children) {

            if( !element.classList.contains('suppr')){

                listInfosElement.push(element);
                
            }
        }

        const libelle = document.querySelector('.div-form-delGallery form .del-libelle');
        const divImg = document.querySelector('.div-form-delGallery form .preview-img-form');

        libelle.innerText = listInfosElement[0].innerText;
        divImg.innerHTML = listInfosElement[1].innerHTML;

        const inputId = document.querySelector('.div-form-delGallery form #form_DelGallery_id');
        inputId.value = e.target.dataset.id;

    });
}

//Annulation form suppr img..
annulFormDelGallery.addEventListener('click', function(){

    const libelle = document.querySelector('.div-form-delGallery form .del-libelle');
    const divImg = document.querySelector('.div-form-delGallery form .preview-img-form');

    libelle.innerText = '';
    divImg.innerHTML = '';

    backgroundForm.classList.add('hidden');
    divFormDelGallery.classList.add('hidden');
});

//Déclenchement form ajout image..
addButtonGallery.addEventListener('click', function(e){

    backgroundForm.classList.remove('hidden');
    divFormGallery.classList.remove('hidden');

    const inputId = document.querySelector('.div-form-gallery form #form_gallery_id');
    inputId.value = e.target.dataset.id;

});

//Déclenchement preview de l'image..
inputFile.addEventListener('change', function(e){

    const divImg = document.querySelector('.div-form-gallery form .preview-img-form');

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
        }
    }

});

//Annulation form ajout img..
annulFormGallery.addEventListener('click', function(){
    
    const url = document.querySelector('.div-form-gallery form div input');
    const divImg = document.querySelector('.div-form-gallery form .preview-img-form');

    url.value = '';
    divImg.innerHTML = '';

    backgroundForm.classList.add('hidden');
    divFormGallery.classList.add('hidden');
});

//Déclenchement form infos..
for (const update of updateButtonInfo) {

    update.addEventListener('click', function(e){

        backgroundForm.classList.remove('hidden');
        divFormInfo.classList.remove('hidden');

        const containerElements = e.target.parentNode;
        let listInfosElement = [];
        
        for (const element of containerElements.children) {

            if( !element.classList.contains('modifier')){

                listInfosElement.push(element.innerText);
                
            }
        }

        const libelleInput = document.querySelector('.div-form-info form div input');
        const textArea = document.querySelector('.div-form-info form div textarea');

        libelleInput.value = listInfosElement[0];
        textArea.value = listInfosElement[1];

        const inputId = document.querySelector('.div-form-info form #form_informations_id');
        inputId.value = e.target.dataset.id;

    });
}

//Annulation form infos..
annulFormInfo.addEventListener('click', function(){

    const libelleInput = document.querySelector('.div-form-info form div input');
    const textArea = document.querySelector('.div-form-info form div textarea');

    libelleInput.value = '';
    textArea.value = '';

    backgroundForm.classList.add('hidden');
    divFormInfo.classList.add('hidden');
});

//Déclenchement form tarifs..
for (const update of updateButtonTarifs) {

    update.addEventListener('click', function(e){

        backgroundForm.classList.remove('hidden');
        divFormTarifs.classList.remove('hidden');

        const containerElements = e.target.parentNode;
        let listInfosElement = [];
        
        for (const element of containerElements.children) {

            if( !element.classList.contains('modifier')){

                if(element.getAttribute('class') == 'table-info'){

                    let valueElement = element.innerText.replace('€', '');

                    if(!valueElement.includes('.')){

                        valueElement = valueElement + '.00';

                    }else{

                        valueElement = valueElement.split('.');
                        valueElement = valueElement[0] + '.' + valueElement[1].padEnd(2,'0');

                    }

                    listInfosElement.push(valueElement);

                }else{

                    listInfosElement.push(element.innerText);

                }
                
                
            }
        }

        const libelleInput = document.querySelector('.div-form-tarifs form div #form_tarifs_libelle');
        const valueInput = document.querySelector('.div-form-tarifs form div #form_tarifs_valeur');

        libelleInput.value = listInfosElement[0];
        valueInput.value = listInfosElement[1];

        const inputId = document.querySelector('.div-form-tarifs form #form_tarifs_id');
        inputId.value = e.target.dataset.id;

    });
}

//Annulation form tarifs..
annulFormTarifs.addEventListener('click', function(){

    const libelleInput = document.querySelector('.div-form-tarifs form div #form_tarifs_libelle');
    const valueInput = document.querySelector('.div-form-tarifs form div #form_tarifs_valeur');

    libelleInput.value = '';
    valueInput.value = '';

    backgroundForm.classList.add('hidden');
    divFormTarifs.classList.add('hidden');
});

//Déclenchement form pmr..
for (const update of updateButtonAccesPmr) {

    update.addEventListener('click', function(e){

        backgroundForm.classList.remove('hidden');
        divFormAccesPmr.classList.remove('hidden');

        const containerElements = e.target.parentNode;
        let infoElement = containerElements.children[0];
        

        const libelleInput = document.querySelector('.div-form-accesPmr form div input');
        libelleInput.value = infoElement.innerText;

        const inputId = document.querySelector('.div-form-accesPmr form #form_AccesPmr_id');
        inputId.value = e.target.dataset.id;

    });
}

//Annulation form pmr..
annulFormAccesPmr.addEventListener('click', function(){

    const libelleInput = document.querySelector('.div-form-accesPmr form div input');

    libelleInput.value = '';

    backgroundForm.classList.add('hidden');
    divFormAccesPmr.classList.add('hidden');
});

//Déclenchement form delpmr..
for (const suppr of deleteButtonAccesPmr) {

    suppr.addEventListener('click', function(e){

        backgroundForm.classList.remove('hidden');
        divFormDelAccesPmr.classList.remove('hidden');

        const containerElements = e.target.parentNode;
        let infoElement = containerElements.children[0];
        

        const libelle = document.querySelector('.div-form-delAccesPmr form .del-libelle');
        libelle.innerText = infoElement.innerText;

        const inputId = document.querySelector('.div-form-delAccesPmr form #form_DelAccesPmr_id');
        inputId.value = e.target.dataset.id;

    });
}

//Annulation form delpmr..
annulFormDelAccesPmr.addEventListener('click', function(){

    const libelle = document.querySelector('.div-form-delAccesPmr form .del-libelle');
    libelle.innerText = '';

    backgroundForm.classList.add('hidden');
    divFormDelAccesPmr.classList.add('hidden');
});

//Déclenchement form addpmr..
addButtonAccesPmr.addEventListener('click', function(e){

    backgroundForm.classList.remove('hidden');
    divFormAccesPmr.classList.remove('hidden');

    const inputId = document.querySelector('.div-form-accesPmr form #form_AccesPmr_id');
    inputId.value = e.target.dataset.id;

});


//Annulation form addpmr..
annulFormAccesPmr.addEventListener('click', function(){

    const libelleInput = document.querySelector('.div-form-accesPmr form div input');

    libelleInput.value = '';

    backgroundForm.classList.add('hidden');
    divFormAccesPmr.classList.add('hidden');
});

}