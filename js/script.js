// This code handles the toggling of the menu and navbar.
let menu = document.querySelector('#menu-btn');
let navbar = document.querySelector('.header .navbar');

menu.onclick = () =>{
   menu.classList.toggle('fa-times');
   navbar.classList.toggle('active');//used to show or hide the navbar
};


// Initializes a Swiper instance for the home slider
var swiper = new Swiper(".home-slider", {
   loop:true,
   navigation: {
     nextEl: ".swiper-button-next",
     prevEl: ".swiper-button-prev",
   },
});

// Initializes another Swiper instance for the reviews slider with different settings
var swiper = new Swiper(".reviews-slider", {
   grabCursor:true,
   loop:true,
   autoHeight:true,
   spaceBetween: 20,
   breakpoints: {
      0: {
        slidesPerView: 1,//1 slide per view for screens up to 700px.
      },
      700: {
        slidesPerView: 2,//2 slides per view for screens between 700px and 1000px.
      },
      1000: {
        slidesPerView: 3,// 3 slides per view for screens 1000px and wider.
      },
   },
});


//Handles the "load more" functionality for displaying additional package boxes.
let loadMoreBtn = document.querySelector('.packages .load-more .btn');
let currentItem = 3;

loadMoreBtn.onclick = () =>{
   let boxes = [...document.querySelectorAll('.packages .box-container .box')];
   for (var i = currentItem; i < currentItem + 3; i++){
      boxes[i].style.display = 'inline-block';
   };
   currentItem += 3;
   if(currentItem >= boxes.length){
      loadMoreBtn.style.display = 'none';
   }
}

