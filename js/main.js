// sticky

window.onscroll = function () { myFunction() };

var header = document.getElementById("header");
var sticky = header.offsetTop;
function myFunction() {
    if (window.pageYOffset > sticky) {
        header.classList.add("sticky");
    } else {
        header.classList.remove("sticky");
    }
}

// burger menu
var burger = document.querySelector('.burger img');
var closeIcon = document.querySelector('.close-icon');
var btnBurger = document.querySelector('.burger__btn')
var body = document.body;
var menuItems = document.querySelectorAll('.menu-item a');

menuItems.forEach(function (item) {
    item.addEventListener('click', function () {
        body.classList.remove('_lock', 'open-burger');
    });
});

burger.addEventListener('click', function () {

    body.classList.add('_lock', 'open-burger');
});

closeIcon.addEventListener('click', function () {

    body.classList.remove('_lock', 'open-burger');
});
btnBurger.addEventListener('click', function () {

    body.classList.remove('_lock', 'open-burger');
});


// inputmask

document.addEventListener('DOMContentLoaded', function () {
    var telInput = document.querySelectorAll('.wpcf7-tel');
    if (telInput) {
        Inputmask("+7 (999) 999-99-99").mask(telInput);
    }
});


// add animation on visible
document.addEventListener('DOMContentLoaded', () => {
    const fadeInBlocks = document.querySelectorAll('.fade-in-block');

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    });

    fadeInBlocks.forEach(block => {
        observer.observe(block);
    });
});



// swiper
const swiper = new Swiper('.swiper', {
    loop: true,
    autoplay: {
        delay: 4000,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    spaceBetween: 16,
    centeredSlides: true,
    slidesPerView: 1.3,
    breakpoints: {
        600: {
            centeredSlides: false,
            slidesPerView: 2
        },
        990: {
            centeredSlides: false,
            slidesPerView: 3
        },
        1100: {
            centeredSlides: false,
            slidesPerView: 4
        },
    },
});
