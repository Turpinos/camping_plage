const mainAdminDetail = document.querySelector('.main-admin-loc');

if(mainAdminDetail != undefined){
//ouih
const pings = document.querySelectorAll('.map-container .ping');


for (const ping of pings ) {
    ping.classList.remove('hidden');
}

}