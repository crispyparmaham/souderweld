addEventListener("DOMContentLoaded", (event) => {
    let swipers = document.querySelectorAll('.geschichte-swiper');

    var swiper = new Swiper(".geschichte-swiper", {
        slidesPerView: 3,
        spaceBetween: 30,
        centeredSlides: false,
        breakpoints: {
            1120: {
                slidesPerView: 3,
                spaceBetween: 20
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 20
            },
            300: {
                slidesPerView: 1,
                spaceBetween: 10
            }
        }
    });
});
