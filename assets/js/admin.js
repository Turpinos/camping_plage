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

//List des buttons d'annulations des formulaires..
const annulFormSaisons = document.querySelector('.div-form-saisons .annuler button');
const annulFormOuvertures = document.querySelector('.div-form-ouvertures .annuler button');
const annulFormGallery = document.querySelector('.div-form-gallery .annuler button');
const annulFormInfo = document.querySelector('.div-form-info .annuler button');
const annulFormTarifs = document.querySelector('.div-form-tarifs .annuler button');
const annulFormAccesPmr = document.querySelector('.div-form-accesPmr .annuler button');


//Boutons pour déclencher l'apparition des formulaires..
const updateButtonSaisons = document.querySelectorAll('.modifier-saisons');
const updateButtonOuvertures = document.querySelectorAll('.modifier-ouvertures');
const updateButtonInfo = document.querySelectorAll('.modifier-info');
const updateButtonTarifs = document.querySelectorAll('.modifier-tarifs');
const updateButtonAcces = document.querySelectorAll('.modifier-acces');


//Ouvrir auto. si une erreur est détectée dans un form..

//Déclenchement form..
for (const update of updateButtonSaisons) {

    update.addEventListener('click', function(e){

        backgroundForm.classList.remove('hidden');
        divFormSaisons.classList.remove('hidden');

        const containerElements = e.target.parentNode;
        
        for (const element of containerElements.children) {

            console.log(element);
            //console.log(typeof element)
            
            //if(element.classList.contains('modifier') && element.ELEMENT_NODE == 1){
            //    console.log('oiu');
            //    
            //}
            
        }
    });
}

//Annulation form..
annulFormSaisons.addEventListener('click', function(){

    backgroundForm.classList.add('hidden');
    divFormSaisons.classList.add('hidden');
});

}