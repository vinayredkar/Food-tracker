var btn = document.querySelector('.card_fav_btn');

btn.addEventListener('click', () => {
  console.log('m');
  let myImg = btn.getAttribute('img');
  let mySrc = img.getAttribute('src');
  if(mySrc === '../images/favourite_not_selected.svg') {
    mySrc.image.setAttribute('src','../images/favourite_selected.svg');
  } else {
    myImage.setAttribute('src','../images/favourite_not_selected.svg');
  }})