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

            <a href="{{ route('menu.show') }}" class="button">
                Order Now <i class="ri-arrow-right-line"></i>
            </a>
        </div>
    </div>

    <img src="{{ asset('img/leaf-branch-2.png') }}" alt="home image" class="home__leaf-1">
    <img src="{{ asset('img/leaf-branch-4.png') }}" alt="home image" class="home__leaf-2">
</section>
