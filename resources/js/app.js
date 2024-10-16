import './bootstrap';

const navMenu = document.getElementById('nav-menu'),
    navToggle = document.getElementById('nav-toggle'),
    navClose = document.getElementById('nav-close');

if (navToggle) {
    navToggle.addEventListener('click', () => {
        navMenu.classList.add('show-menu');
    });
}

if (navClose) {
    navClose.addEventListener('click', () => {
        navMenu.classList.remove('show-menu');
    });
}

const navLink = document.querySelectorAll('.nav__link');

const linkAction = () => {
    const navMenu = document.getElementById('nav-menu');
    navMenu.classList.remove('show-menu');
};
navLink.forEach(n => n.addEventListener('click', linkAction));

const scrollHeader = () => {
    const header = document.getElementById('header');
    window.scrollY >= 50 ? header.classList.add('bg-header') : header.classList.remove('bg-header');
};
window.addEventListener('scroll', scrollHeader);

const scrollUp = () => {
    const scrollUp = document.getElementById('scroll-up');
    window.scrollY >= 350 ? scrollUp.classList.add('show-scroll') : scrollUp.classList.remove('show-scroll');
};

window.addEventListener('scroll', scrollUp);

const sections = document.querySelectorAll('section[id]');
const navLinks = document.querySelectorAll('.nav__link');

const scrollActive = () => {
    const scrollY = window.pageYOffset;

    sections.forEach(current => {
        const sectionHeight = current.offsetHeight,
            sectionTop = current.offsetTop - 58,
            sectionId = current.getAttribute('id');

        navLinks.forEach(link => {
            // Сопоставляем ссылку с секцией
            if (link.getAttribute('href').includes(sectionId) &&
                scrollY >= sectionTop &&
                scrollY < sectionTop + sectionHeight) {
                link.classList.add('active-link');
            } else {
                link.classList.remove('active-link');
            }
        });
    });
};

window.addEventListener('scroll', scrollActive);

const themeButton = document.getElementById('theme-button');
const darkTheme = 'dark-theme';
const iconTheme = 'ri-sun-line';

const selectedTheme = localStorage.getItem('selected-theme');
const selectedIcon = localStorage.getItem('selected-icon');

const getCurrentTheme = () => document.body.classList.contains(darkTheme) ? 'dark' : 'light';
const getCurrentIcon = () => themeButton.classList.contains(iconTheme) ? 'ri-moon-line' : 'ri-sun-line';

if (selectedTheme) {
    document.body.classList[selectedTheme === 'dark' ? 'add' : 'remove'](darkTheme);
    themeButton.classList[selectedIcon === 'ri-moon-line' ? 'add' : 'remove'](iconTheme);
}

themeButton.addEventListener('click', () => {
    document.body.classList.toggle(darkTheme);
    themeButton.classList.toggle(iconTheme);

    localStorage.setItem('selected-theme', getCurrentTheme());
    localStorage.setItem('selected-icon', getCurrentIcon());
});

const sr = ScrollReveal({
    origin: 'top',
    distance: '60px',
    duration: 2500,
    delay: 400,
    // reset: true,
});

sr.reveal(`.home__img, .newsletter__container, .footer__logo, .footer__description, .footer__content, .footer__info`);
sr.reveal(`.home__data`, {origin: 'bottom'});
sr.reveal(`.about__data, .recently__data`, {origin: 'left'});
sr.reveal(`.about__img, .recently__img`, {origin: 'right'});
sr.reveal(`.popular__card`, {interval: 100});

//Order
document.addEventListener('DOMContentLoaded', function () {
    const phoneInput = document.getElementById('phone');

    phoneInput.addEventListener('focus', function () {
        if (phoneInput.value === '+375') {
            phoneInput.setSelectionRange(4, 4);
        }
    });

    phoneInput.addEventListener('input', function () {
        if (!phoneInput.value.startsWith('+375')) {
            phoneInput.value = '+375';
        }
    });
});

// End Order

// AJAX
$(document).ready(function() {
    $('.add-to-cart').on('click', function() {
        const menuId = $(this).data('id');

        $.ajax({
            url: '/cart/add/' + menuId,
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            // success: function(response) {
            //     if (response.success) {
            //         alert(response.success);
            //     } else {
            //         alert('Произошла ошибка.');
            //     }
            // },
            // error: function(xhr) {
            //     if (xhr.responseJSON && xhr.responseJSON.error) {
            //         alert('Ошибка: ' + xhr.responseJSON.error);
            //     } else {
            //         alert('Неизвестная ошибка.');
            //     }
            // }
        });
    });
});

// $(document).ready(function() {
//     $('.remove-from-cart').on('click', function(e) {
//         e.preventDefault(); // Предотвращаем стандартное поведение
//
//         const form = $(this).closest('form'); // Получаем форму
//         const url = form.attr('action'); // Получаем URL формы
//
//         $.ajax({
//             url: url,
//             method: 'POST',
//             data: {
//                 _token: $('meta[name="csrf-token"]').attr('content') // CSRF-токен
//             },
//             success: function(response) {
//                 // Показываем сообщение об успехе
//                 toastr.error('Товар удален!', 'Успех', {
//                     "closeButton": true,
//                     "progressBar": true,
//                     "timeOut": "2000", // Убираем окно через 2 секунды
//                 });
//
//                 // Удаляем элемент из корзины
//                 form.closest('.cart-item').remove(); // Удаляем элемент, если он существует
//             },
//             error: function(xhr) {
//                 toastr.error('Ошибка: ' + xhr.responseJSON.message);
//             }
//         });
//     });
// });


// End AJAX

//Start Toastr

toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "2000",  // 1000 миллисекунд (1 секунда)
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

document.addEventListener('DOMContentLoaded', function () {
    const addToCartButtons = document.querySelectorAll('.add-to-cart');

    addToCartButtons.forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.getAttribute('data-id');

            toastr.success('Товар добавлен в корзину!');
        });
    });
});

// End Toastr
