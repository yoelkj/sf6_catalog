
import './style.css';

//On scroll page
let scrollPos = 0;

const obj_slogan = document.querySelector('.container-logo em');
function checkPosition() {
  let windowY = window.scrollY;
  
  console.log(windowY,scrollPos);

  if (windowY <= 50) {
    // Scrolling UP
    obj_slogan.classList.add('d-block');
    obj_slogan.classList.remove('d-none');
  } else {
    // Scrolling DOWN
    obj_slogan.classList.add('d-none');
    obj_slogan.classList.remove('d-block');
  }
  scrollPos = windowY;
}
window.addEventListener('scroll', checkPosition);
//END on scroll page