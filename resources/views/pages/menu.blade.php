@extends('components.layout')

@section('content')
    <section class="popular section" id="popular">
        <h1 class="section__subtitle">Menu</h1>

        @foreach($menus as $category => $items)
            <h2 class="section__title">{{ ucfirst($category) }}</h2>

            <div class="popular__container container grid">
                @foreach($items as $menu)
                    <article class="popular__card">
                        @if($menu->image)
                            <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="popular__img">
                        @else
                            <img src="{{ asset('path/to/default-image.jpg') }}" alt="Default Image" class="popular__img">
                        @endif

                        <h3 class="popular__name">{{ $menu->name }}</h3>
                        <span class="popular__description">{{ $menu->description }}</span>
                        <span class="popular__price">$ {{ $menu->price }}</span>

                        @auth
                            <button type="button" class="popular__button add-to-cart" data-id="{{ $menu->id }}">
                                <i class="ri-shopping-bag-line"></i>
                            </button>
                        @endauth
                        @guest
                            <a href="{{ route('login') }}" class="popular__button">
                                <i class="ri-shopping-bag-line"></i>
                            </a>
                        @endguest
                    </article>
                @endforeach
            </div>
        @endforeach
    </section>
@endsection

