const mainReservation = document.getElementById('reservation');

if(mainReservation != undefined){

const nbrVoyageurs = document.querySelector('#reservation_nombreVoyageurs');
const containerVoyageurs = document.querySelector('.container-card-voyageurs div');
const buttonForm = document.getElementById('reservation_save');
let initQtyVoyageur = nbrVoyageurs.value;
const emptyCardVoyageur = document.querySelector('.container-card-voyageurs div .row');
const checkCampingCar = document.querySelector('.camping-car');
const checkCaravane = document.querySelector('.caravane');
const checktente = document.querySelector('.tente');
const containerOption = document.querySelector('.facultatif-container');
const dateDebutSejour = document.getElementById('reservation_debutDuSejour');
const dateFinSejour = document.getElementById('reservation_finDuSejour');


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
checkCampingCar.lastChild.addEventListener('click', function(e){
    activeOption(e.target.checked, checkCaravane, checktente);
});

checkCaravane.lastChild.addEventListener('click', function(e){
    activeOption(e.target.checked, checkCampingCar, checktente);
});

checktente.lastChild.addEventListener('click', function(e){
    activeOption(e.target.checked, checkCampingCar, checkCaravane);
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
        const ul = document.createElement('ul');
        const li = document.createElement('li');
        li.innerText = 'Doit être inférieure à la fin.';
        ul.appendChild(li);
        document.querySelector('.debut').insertBefore(ul, dateDebutSejour);
    }else if (targetDate < currDate) {
        e.target.value = '';
        const ul = document.createElement('ul');
        const li = document.createElement('li');
        li.innerText = 'La date est passée.';
        ul.appendChild(li);
        document.querySelector('.debut').insertBefore(ul, dateDebutSejour);
    }
    
    
    
});

//Evenement de contrôle de date de début.
dateFinSejour.addEventListener('change', function(e){
    const targetDate = new Date(e.target.value);
    const compareDate = new Date(dateDebutSejour.value)
    const currDate = new Date();
    
    if(document.querySelector('.fin ul')){
        document.querySelector('.fin').removeChild(document.querySelector('.fin ul'));
    }
    
    if(targetDate < compareDate){
        e.target.value = '';
        const ul = document.createElement('ul');
        const li = document.createElement('li');
        li.innerText = 'Doit être supérieur au début.';
        ul.appendChild(li);
        document.querySelector('.fin').insertBefore(ul, dateFinSejour);
    }else if (targetDate < currDate) {
        e.target.value = '';
        const ul = document.createElement('ul');
        const li = document.createElement('li');
        li.innerText = 'La date est passée.';
        ul.appendChild(li);
        document.querySelector('.fin').insertBefore(ul, dateFinSejour);
    }
    
    
    
});

//Vérification du formulaire.
buttonForm.addEventListener('click', function(){

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
}

}