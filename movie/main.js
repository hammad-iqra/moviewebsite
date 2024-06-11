var swiper = new Swiper(".home", {
    spaceBetween: 30,
    centeredSlides: true,
    autoplay: {
      delay: 2500,
      disableOnInteraction: false,
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    
  });
 
  document.addEventListener("DOMContentLoaded", function() {
    const header = document.querySelector("header");
    const menuIcon = document.querySelector(".menu-icon");
    const navbar = document.querySelector(".navbar");
  
    window.addEventListener("scroll", function() {
      if (window.scrollY > 0) {
        header.classList.add("scrolled");
      } else {
        header.classList.remove("scrolled");
      }
    });
  
    menuIcon.addEventListener("click", function() {
      navbar.classList.toggle("active");
    });
  });
  
