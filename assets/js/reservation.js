const mainReservation = document.getElementById('reservation');

if(mainReservation != undefined){

const containerVoyageurs = document.querySelector('.container-card-voyageurs div');
const buttonForm = document.getElementById('reservation_save');
const emptyCardVoyageur = document.querySelector('.container-card-voyageurs div .row');
const checkCampingCar = document.querySelector('.camping-car');
const checkCaravane = document.querySelector('.caravane');
const checktente = document.querySelector('.tente');
const containerOption = document.querySelector('.facultatif-container');
const dateDebutSejour = document.getElementById('reservation_debutDuSejour');
const dateFinSejour = document.getElementById('reservation_finDuSejour');
const inputName = document.getElementById('reservation_name');
const inputFirstName = document.getElementById('reservation_firstName');
const inputEmail = document.getElementById('reservation_email');
const inputaddress = document.getElementById('reservation_address');
const inputTel = document.getElementById('reservation_phone');
const nbrVoyageurs = document.getElementById('reservation_nombreVoyageurs');
let selectAgeVoyageur = document.querySelectorAll('.container-card-voyageurs div .row select');
const listCheckBox = document.querySelectorAll('.container-checkBox .row input');
const hiddenInputAge = document.getElementById('reservation_hiddenInputAge');

let initQtyVoyageur = nbrVoyageurs.value;

//Evénement sur la modification de la quantité de voyageurs et ajustement du nombre de carte en conséquence.
nbrVoyageurs.addEventListener('blur', function(){

    const listCardVoyageur = document.querySelectorAll('.container-card-voyageurs div .row');
    let qtyVoyageur = document.querySelector('#reservation_nombreVoyageurs').value;
    let arrayvalueSelected = [];


    if(qtyVoyageur != initQtyVoyageur){

        for (const card of listCardVoyageur) {
            arrayvalueSelected.push(card.lastChild.value);
        }

        containerVoyageurs.innerHTML = '';

        for(let i = 0; i < qtyVoyageur; i++){

            let div = emptyCardVoyageur.cloneNode(true);
            div.childNodes[0].innerText = `Voyageur ${i+1}`;
            div.childNodes[0].setAttribute('for', `reservation_ageDesVoyageurs${i+1}`)
            div.lastChild.setAttribute('name', `reservation[ageDesVoyageurs${i+1}]`);
            div.lastChild.setAttribute('id', `reservation_ageDesVoyageurs${i+1}`);

            if(arrayvalueSelected[i] != undefined){
                div.lastChild.options[0].removeAttribute('selected');
                div.lastChild.options[arrayvalueSelected[i]].setAttribute('selected', 'selected');
            }
            
            containerVoyageurs.appendChild(div);
            
        }
        
        initQtyVoyageur = qtyVoyageur;

    }
    
});


//Evénement sur l'affichage de l'option.
if(checkCampingCar.lastChild.checked || checkCaravane.lastChild.checked || checktente.lastChild.checked){
    containerOption.classList.remove('disabled');
}

checkCampingCar.lastChild.addEventListener('click', function(e){
    activeOption(e.target.checked, checkCaravane, checktente);
    if(e.target.checked){
        if(document.querySelector('.container-error ul')){
            document.querySelector('.container-error').removeChild(document.querySelector('.container-error ul'));
        }

        document.querySelector('.container-error').appendChild(displayError('Il n\'est pas nécessaire de réserver un emplacement hors haute saison!'));

    }else{
        if(document.querySelector('.container-error ul') && !checkCaravane.lastChild.checked && !checktente.lastChild.checked){
            document.querySelector('.container-error').removeChild(document.querySelector('.container-error ul'));
            console.log(checkCaravane.checked);
            
        }
    }
});

checkCaravane.lastChild.addEventListener('click', function(e){
    activeOption(e.target.checked, checkCampingCar, checktente);
    if(e.target.checked){
        if(document.querySelector('.container-error ul')){
            document.querySelector('.container-error').removeChild(document.querySelector('.container-error ul'));
        }

        document.querySelector('.container-error').appendChild(displayError('Il n\'est pas nécessaire de réserver un emplacement hors haute saison!'));

    }else{
        if(document.querySelector('.container-error ul') && !checkCampingCar.lastChild.checked && !checktente.lastChild.checked){
            document.querySelector('.container-error').removeChild(document.querySelector('.container-error ul'));
        }
    }
});

checktente.lastChild.addEventListener('click', function(e){
    activeOption(e.target.checked, checkCampingCar, checkCaravane);
    if(e.target.checked){
        if(document.querySelector('.container-error ul')){
            document.querySelector('.container-error').removeChild(document.querySelector('.container-error ul'));
        }

        document.querySelector('.container-error').appendChild(displayError('Il n\'est pas nécessaire de réserver un emplacement hors haute saison!'));

    }else{
        if(document.querySelector('.container-error ul') && !checkCampingCar.lastChild.checked && !checkCaravane.lastChild.checked){
            document.querySelector('.container-error').removeChild(document.querySelector('.container-error ul'));
        }
    }
});

// Activation de l'input checkbox directement.
document.getElementById('reservation_electricite').addEventListener('click', function(e){
    if(!(checkCampingCar.lastChild.checked || checkCaravane.lastChild.checked || checktente.lastChild.checked)){
        e.preventDefault();
    }
});


//Evenement de contrôle de date de début.
dateDebutSejour.addEventListener('change', function(e){
    const targetDate = new Date(e.target.value);
    const compareDate = new Date(dateFinSejour.value)
    const currDate = new Date();
    
    if(document.querySelector('.debut ul')){
        document.querySelector('.debut').removeChild(document.querySelector('.debut ul'));
    }
    
    if(targetDate > compareDate){
        e.target.value = '';
        document.querySelector('.debut').insertBefore(displayError('Doit être inférieure à la fin.'), dateDebutSejour);
    }else if (targetDate < currDate) {
        e.target.value = '';
        document.querySelector('.debut').insertBefore(displayError('La date est passée.'), dateDebutSejour);
    }
    
    
    
});

//Evenement de contrôle de date de fin.
dateFinSejour.addEventListener('change', function(e){
    const targetDate = new Date(e.target.value);
    const compareDate = new Date(dateDebutSejour.value)
    const currDate = new Date();
    
    if(document.querySelector('.fin ul')){
        document.querySelector('.fin').removeChild(document.querySelector('.fin ul'));
    }
    
    if(targetDate < compareDate){
        e.target.value = '';
        document.querySelector('.fin').insertBefore(displayError('Doit être supérieur au début.'), dateFinSejour);
    }else if (targetDate < currDate) {
        e.target.value = '';
        document.querySelector('.fin').insertBefore(displayError('La date est passée.'), dateFinSejour);
    }
    
    
    
});

//Vérification du formulaire.
buttonForm.addEventListener('click', function(e){

    selectAgeVoyageur = document.querySelectorAll('.container-card-voyageurs div .row select');
    let validator = true;

    if(document.querySelector('.container-error ul')){
        document.querySelector('.container-error').innerHTML = "";
    }

    if(inputName.value == '' || inputName.value.length < 2 || inputName.value.length > 50 ){
        validator = false;
        
        document.querySelector('.container-error').appendChild(displayError('Le nom doit contenir entre 2 et 50 caractères'));
    }

    if(inputFirstName.value == '' || inputFirstName.value.length < 2 || inputFirstName.value.length > 50){
        validator = false;

        document.querySelector('.container-error').appendChild(displayError('Le prénom doit contenir entre 2 et 50 caractères'));
    }

    if(inputEmail.value == '' || inputEmail.value.length < 6 || inputEmail.value.length > 50){
        validator = false;

        document.querySelector('.container-error').appendChild(displayError('Erreur avec le champ email'));
    }

    if(inputaddress.value == '' || inputaddress.value.length < 10 || inputaddress.value.length > 200){
        validator = false;

        document.querySelector('.container-error').appendChild(displayError('L\'adresse doit contenir entre 10 et 200 caractères'));
    }

    if(inputTel.value == '' || inputTel.value.length < 5 || inputTel.value.length > 20){
        validator = false;

        document.querySelector('.container-error').appendChild(displayError('Erreur avec le champ téléphone'));
    }

    if(nbrVoyageurs.value == '' || nbrVoyageurs.value < 1 ){
        validator = false;

        document.querySelector('.container-error').appendChild(displayError('Entre 1 et 20 voyageurs'));
    }

    let listAge = [];
    for (const select of selectAgeVoyageur) {

        if(select.value != 0){
            listAge.push(select.value);
        }

        if(select.value == 0){
            validator = false;
    
            document.querySelector('.container-error').appendChild(displayError('Erreur avec l\'âge d\'un voyageur'));
        }
    }
    hiddenInputAge.value = JSON.stringify(listAge);

    let isCheck = false
    for (const check of listCheckBox) {
        if(check.checked){
            isCheck = true;
        }
    }

    if(!isCheck){
        validator = false

        document.querySelector('.container-error').appendChild(displayError('Au moins un type de locatif doit être sélectionner'));
    }

    if (dateDebutSejour.value == '') {
        validator = false;

        document.querySelector('.container-error').appendChild(displayError('Erreur avec la date de début'));
    }

    if(dateFinSejour.value == ''){
        validator = false;

        document.querySelector('.container-error').appendChild(displayError('Erreur avec la date de fin'));
    }

    if(!validator){
        e.preventDefault();
    }

});



//#############################################
//Déclaration de fonction...
//#############################################
//Activationde l'affichage de l'option si au moins une des trois dernières checkbox sont active.
function activeOption(bool, check1, check2) {
    if(bool){
        if(containerOption.classList.contains('disabled')){
            containerOption.classList.remove('disabled');
        }
    }else{
        if(!check1.lastChild.checked && !check2.lastChild.checked){
            containerOption.classList.add('disabled');
            document.getElementById('reservation_electricite').checked = false;
        }
    }
};

//Affichage erreurs..
function displayError(message){
    const ul = document.createElement('ul');
    const li = document.createElement('li');
    li.innerText = message;
    ul.appendChild(li);
    return ul;
};

}