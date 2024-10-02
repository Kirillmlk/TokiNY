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
    <section class="home section" id="home">
        <div class="home_container container grid">
            <img src="{{ asset('img/home-sushi-rolls.png') }}" alt="home image" class="home__img">

            <div class="home__data">
                <h1 class="home__title">
                    Enjoy Delicious

                    <div>
                        <img src="{{ asset('img/home-sushi-title.png') }}" alt="home image">
                        Sushi Food
                    </div>
                </h1>

                <p class="home__description">
                    Enjoy a good dinner with the best dishes in
                    the restaurant and improve your day.
                </p>

                <a href="#" class="button">
                    Order Now <i class="ri-arrow-right-line"></i>
                </a>
            </div>
        </div>

        <img src="{{ asset('img/leaf-branch-2.png') }}" alt="home image" class="home__leaf-1">
        <img src="{{ asset('img/leaf-branch-4.png') }}" alt="home image" class="home__leaf-2">
    </section>

    <section class="about section" id="about">
        <div class="about__container container grid">
            <div class="about__data">
                <span class="section__subtitle">About Us</span>
                <h2 class="section__title about__title">
                    <div>
                        We Provide
                        <img src="{{ asset('img/about-sushi-title.png') }}" alt="about image">
                    </div>

                    Healthy Food
                </h2>

                <p class="about__description">
                    Food comes to us from our relatives, whether they
                    have wings or roots. This is how we consider food,
                    it also has a culture. It has a history that passes
                    from generation to generation.
                </p>
            </div>

            <img src="{{ asset('img/about-sushi.png') }}" alt="about image" class="about__img">
        </div>

        <img src="{{ asset('img/leaf-branch-1.png') }}" alt="about image" class="about__leaf">
    </section>


    <section class="popular section" id="popular">
        <span class="section__subtitle">The Best Food</span>
        <h2 class="section__title">Popular Dishes</h2>

        <div class="popular__container container grid">
            <article class="popular__card">
                <img src="{{ asset('img/popular-onigiri.png') }}" alt="popular image" class="popular__img">

                <h3 class="popular__name">Onigiri</h3>
                <span class="popular__description">Japanese Dish</span>

                <span class="popular__price">$10.99</span>

                <button class="popular__button">
                    <i class="ri-shopping-bag-line"></i>
                </button>
            </article>

            <article class="popular__card">
                <img src="{{ asset('img/popular-spring-rols.png') }}" alt="popular image" class="popular__img">

                <h3 class="popular__name">Spring Rolls</h3>
                <span class="popular__description">Japanese Dish</span>

                <span class="popular__price">$15.99</span>

                <button class="popular__button">
                    <i class="ri-shopping-bag-line"></i>
                </button>
            </article>

            <article class="popular__card">
                <img src="{{ asset('img/popular-sushi-rolls.png') }}" alt="popular image" class="popular__img">

                <h3 class="popular__name">Sushi Rolls</h3>
                <span class="popular__description">Japanese Dish</span>

                <span class="popular__price">$19.99</span>

                <button class="popular__button">
                    <i class="ri-shopping-bag-line"></i>
                </button>
            </article>
        </div>
    </section>


    <section class="recently section" id="recently">
        <div class="recently__container container grid">
            <div class="recently__data">
                <span class="section__subtitle">Recently Added</span>
                <h2 class="section__title">
                    Sushi Samurai <br>
                    Salmón Cheese
                </h2>

                <p class="recently__description">
                    Take a look at what's new. And do not deprive
                    yourself of a good meal, enjoy and be happy.
                </p>

                <a href="#" class="button">
                    Order Now <i class="ri-arrow-right-line"></i>
                </a>

                <img src="{{ asset('img/spinach-leaf.png') }}" alt="recently image" class="recently__data-img">
            </div>

            <img src="{{ asset('img/recently-salmon-sushi.png') }}" alt="recently image" class="recently__img">
        </div>

        <img src="{{ asset('img/leaf-branch-2.png') }}" alt="recently image" class="recently__leaf-1">
        <img src="{{ asset('img/leaf-branch-3.png') }}" alt="recently image" class="recently__leaf-2">
    </section>


    <section class="newsletter section">
        <div class="newsletter__container container grid">
            <div class="newsletter__content grid">
                <img src="{{ asset('img/newsletter-sushi.png') }}" alt="newsletter image" class="newsletter__img">

                <div class="newsletter__data">
                    <span class="section__subtitle">Newsletter</span>
                    <h2 class="section__title">
                        Subscribe For <br>
                        Offer Updates
                    </h2>

                    <form action="" class="newsletter__form">
                        <input type="email" placeholder="Enter email" class="newsletter__input">

                        <button class="button newsletter__button">
                            Subscribe <i class="ri-send-plane-line"></i>
                        </button>
                    </form>
                </div>
            </div>

            <img src="{{ asset('img/spinach-leaf.png') }}" alt="newsletter image" class="newsletter__spinach">
        </div>
    </section>
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
