var btn = document.querySelectorAll('.card_fav_btn, .fav_btn');
btn.forEach(elem => {
    //depois ligar à base de dados ?
    elem.addEventListener('click', () => {
        myImg = elem.querySelector('img');
        mySrc = myImg.getAttribute('src');
        if (mySrc === '../images/favourite_not_selected.svg') {
            myImg.setAttribute('src', '../images/favourite_selected.svg');
        } else {
            myImg.setAttribute('src', '../images/favourite_not_selected.svg');
        }
    })
})



function addToFavRest(rest_id) {
    console.log('rest'+rest_id);
    var xmlhttp = new XMLHttpRequest();
    image = document.getElementById('rest'+rest_id);
    mySrc = image.getAttribute('src');


    if (mySrc === '../images/favourite_not_selected.svg') {
        image.setAttribute('src', '../images/favourite_selected.svg');
        xmlhttp.open("get", "../actions/action_add_favorite_rest.php?q=" + rest_id, true);
        xmlhttp.send();
    } else {
        image.setAttribute('src', '../images/favourite_not_selected.svg');
        xmlhttp.open("get", "../actions/action_delete_fav_rest.php?q=" + rest_id, true);
        xmlhttp.send();
    }

}

function addToFavDish(prato_id){
    console.log('prato'+prato_id);
    var xmlhttp = new XMLHttpRequest();
    image = document.getElementById('prato'+prato_id);
    mySrc = image.getAttribute('src');


    if (mySrc === '../images/favourite_not_selected.svg') {
        image.setAttribute('src', '../images/favourite_selected.svg');
        xmlhttp.open("get", "../actions/action_add_favorite_dish.php?q=" + prato_id, true);
        xmlhttp.send();
    } else {
        image.setAttribute('src', '../images/favourite_not_selected.svg');
        xmlhttp.open("get", "../actions/action_delete_fav_dish.php?q=" + prato_id, true);
        xmlhttp.send();
    }
}