var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active-acc");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    }
  });
}


/* == Sticky NavBar == */
//Create A Responsive Menu Hide Show Side Menu
const header = document.querySelector(".header-scroll");
const menuBtn = document.querySelector(".menu-btn");
const cancelBtn = document.querySelector(".cancel-btn");
const menu = document.querySelector(".links");
// Onscroll Change Nav Bar Background
window.onscroll = ()=>{
    this.scrollY > 20 ? header.classList.add("sticky") : header.classList.remove("sticky");
    this.scrollY > 80 ? toTop.classList.add("show") : toTop.classList.remove("show");
}
const toTop = document.querySelector(".to-top");

// Onclick For Menu Bar
menuBtn.onclick = ()=>{
    menu.classList.add("active");
    menuBtn.classList.add("hide");
}

// Onclick For Cancel Menu 
cancelBtn.onclick = ()=>{
    menu.classList.remove("active");
    menuBtn.classList.remove("hide");
}

/* == Sticky NavBar == */


/* == RIBBLE EFFECT == */
// document.onclick = () => applyCursorRippleEffect(event);

// function applyCursorRippleEffect(e) {
//    const ripple = document.createElement("div");
  
//    ripple.className = "ripple";
//    document.body.appendChild(ripple);

//   ripple.style.left = `${e.clientX}px`;
//   ripple.style.top = `${e.clientY}px`; 
//    ripple.style.animation = `ripple-effect .4s  linear`;
//    ripple.onanimationend = () => {
//      document.body.removeChild(ripple);
     
//    }
  
// }

// // extra and optional part:

// const all = document.body.getElementsByTagName("*");
// for (var i = 0;  i < all.length; ++i) {
//   all[i].onclick = (event) => event.stopPropagation();
// }

// If you remove this part you will realise  the ripple overlap. If you select the h1 element in the body the ripple is triggered. Perhaps you don't want that behaviour (the event bubbling down to body children), and so you may add this code. ITS DANGEROUS: for this occasion you may want, but there is specific cases wherein you don't want it at all. Its annoying, just like the discussion o Dev.to pointed out. This pen is simple, so it hasn't such problems. Links, buttons, css hovers, still work, but the ripple don't, that is, it will trigger only where you specifiy: body. As I said, there are possibily occasions you will have to specifiy which kind of elements won't receive this behaviour. This part is general, all elements in body don't receive propagation from its father.
/* == RIBBLE EFFECT == */

/* == TESTIMONIAL TABS == */
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("testimonial");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  slides[slideIndex-1].style.display = "block";  

}

/* == TESTIMONIAL TABS == */



/* == ANIMATION CSS == */
function reveal() {
  var reveals = document.querySelectorAll(".reveal");

  for (var i = 0; i < reveals.length; i++) {
    var windowHeight = window.innerHeight;
    var elementTop = reveals[i].getBoundingClientRect().top;
    var elementVisible = 4;

    if (elementTop < windowHeight - elementVisible) {
      reveals[i].classList.add("showreveal");
    }
  }
}

window.addEventListener("scroll", reveal);
/* == ANIMATION CSS == */

/* == BACK TO TOP == */
// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
/* == BACK TO TOP == */
function slowScroll() {
  setTimeout(() => {
    location.href='#products';
  }, 1200);
}

/* == Cursor == */
// (function (){
//   var cursor = document.querySelector('.cursor');

//   var editCursor = function editCursor(event){
//      cursor.style.left = event.clientX + 'px';
//      cursor.style.top = event.clientY + 'px';
//   };

//   window.addEventListener('mousemove', editCursor);

// })();
/* == || Cursor == */
