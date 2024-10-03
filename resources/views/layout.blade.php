<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    @vite(['resources/css/app.css'])

    <title>TokiNY</title>
</head>
<body>
<header class="header" id="header">
    <nav class="nav container">
        <a href="#" class="nav__logo">
            <img src="{{ asset('img/logo.png') }}" alt="logo image">
            Sushi
        </a>

        <div class="nav__menu" id="nav-menu">
            <ul class="nav__list">
                <li class="nav__item">
                    <a href="#home" class="nav__link active-link">Home</a>
                </li>

                <li class="nav__item">
                    <a href="#about" class="nav__link">About us</a>
                </li>

                <li class="nav__item">
                    <a href="#popular" class="nav__link">Popular</a>
                </li>

                <li class="nav__item">
                    <a href="#recently" class="nav__link">Recently</a>
                </li>
            </ul>

            <!-- Close button -->
            <div class="nav__close" id="nav-close">
                <i class="ri-close-line"></i>
            </div>

            <img src="{{ asset('img/leaf-branch-4.png') }}" alt="nav image" class="nav__img-1">
            <img src="{{ asset('img/leaf-branch-3.png') }}" alt="nav image" class="nav__img-2">
        </div>

        <div class="nav__buttons">
            <!-- Theme change button -->
            <i class="ri-moon-line change-theme" id="theme-button"></i>

            <!-- Toggle button -->
            <div class="nav__toggle" id="nav-toggle">
                <i class="ri-apps-2-line"></i>
            </div>
        </div>
    </nav>
</header>

<main class="main">

@yield('main_content')

</main>

<footer class="footer">
    <div class="footer__container container grid">
        <div>
            <a href="#" class="footer__logo">
                <img src="{{ asset('img/logo.png') }}" alt="logo image">
                Sushi
            </a>

            <p class="footer__description">
                Food for the body is not <br>
                enough. There must be food <br>
                for the soul.
            </p>
        </div>

        <div class="footer__content">
            <div>
                <h3 class="footer__title">Main Menu</h3>
                <ul class="footer__links">
                    <li>
                        <a href="#home" class="footer__link">Home</a>
                    </li>
                    <li>
                        <a href="#about" class="footer__link">About Us</a>
                    </li>
                    <li>
                        <a href="#popular" class="footer__link">Popular</a>
                    </li>
                    <li>
                        <a href="#recently" class="footer__link">Recently</a>
                    </li>
                </ul>
            </div>

            <div>
                <h3 class="footer__title">Information</h3>
                <ul class="footer__links">
                    <li>
                        <a href="#" class="footer__link">Event</a>
                    </li>
                    <li>
                        <a href="#" class="footer__link">Contact Us</a>
                    </li>
                    <li>
                        <a href="#" class="footer__link">Privacy Policy</a>
                    </li>
                    <li>
                        <a href="#" class="footer__link">Terms of Services</a>
                    </li>
                </ul>
            </div>

            <div>
                <h3 class="footer__title">Address</h3>
                <ul class="footer__links">
                    <li class="footer__information">
                        Av. Hacienda, Juan Pablo City
                    </li>
                    <li class="footer__information">
                        24 - 855 - 4555
                    </li>
                    <li class="footer__information">
                        info@email.com
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <img src="{{ asset('img/leaf-branch-4.png') }}" alt="footer image" class="footer__leaf">
    <img src="{{ asset('img/spinach-leaf.png') }}" alt="footer image" class="footer__spinach">
</footer>
<script src="https://unpkg.com/scrollreveal"></script>
@vite(['resources/js/app.js'])
</body>
</html>
