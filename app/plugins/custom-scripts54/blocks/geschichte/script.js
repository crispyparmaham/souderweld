addEventListener("DOMContentLoaded", (event) => {
    console.log('Das Geschichtescript lädt');


    let swipers = document.querySelectorAll('.swiper');

    var swiper = new Swiper(".swiper", {
        slidesPerView: 3,
        spaceBetween: 30,
        centeredSlides: false,
    });

});