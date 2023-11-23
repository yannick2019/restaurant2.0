// active navbar
let nav = document.querySelector(".navigation-wrap");
window.onscroll = function() {
    if (document.documentElement.scrollTo > 20) { 
        nav.classList.add("scroll-on");
    } else {
        nav.classList.remove("scroll-on");
    }
}

 /**
   * Events slider
   */
new Swiper('.events-slider', {
    speed: 600,
    loop: true,
    autoplay: {
        delay: 5000,
        disableOnInteraction: false
    },
    slidesPerView: 'auto',
    pagination: {
        el: '.swiper-pagination',
        type: 'bullets',
        clickable: true
    }
});



