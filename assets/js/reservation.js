const mainReservation = document.getElementById('reservation');

if(mainReservation != undefined){
//ler
const nbrVoyageurs = document.querySelector('#reservation_nombreVoyageurs');
const containerVoyageurs = document.querySelector('.container-card-voyageurs div');
let initQtyVoyageur = nbrVoyageurs.value;
const emptyCardVoyageur = document.querySelector('.container-card-voyageurs div .row');

nbrVoyageurs.addEventListener('blur', function(){

    const listCardVoyageur = document.querySelectorAll('.container-card-voyageurs div .row');
    let qtyVoyageur = document.querySelector('#reservation_nombreVoyageurs').value;

    if(qtyVoyageur != initQtyVoyageur){

        let arrayvalueSelected = [];
        for (const card of listCardVoyageur) {
            arrayvalueSelected.push(card.childNodes[1].value);
        }

        containerVoyageurs.innerHTML = '';

        for(let i = 0; i < qtyVoyageur; i++){

            let div = emptyCardVoyageur.cloneNode(true);
            div.childNodes[0].innerText = `Voyageur ${i+1}`;
            div.childNodes[0].setAttribute('for', `reservation_ageDesVoyageurs${i+1}`)
            div.childNodes[1].setAttribute('name', `reservation[ageDesVoyageurs${i+1}]`);
            div.childNodes[1].setAttribute('id', `reservation_ageDesVoyageurs${i+1}`);

            if(arrayvalueSelected[i] != undefined){
                div.childNodes[1].options[0].removeAttribute('selected');
                div.childNodes[1].options[arrayvalueSelected[i]].setAttribute('selected', 'selected');
            }
            console.log(div.childNodes[1].options[div.childNodes[1].value].getAttribute('selected'));
            
            containerVoyageurs.appendChild(div);
            console.log(arrayvalueSelected[i]);
            
            
        }
        
        initQtyVoyageur = qtyVoyageur;

    }
    
});


}