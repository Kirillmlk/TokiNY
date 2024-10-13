@extends('components.layout')

@section('content')
    <section class="popular section" id="popular">
        <span class="section__subtitle">Menu</span>
        <h2 class="section__title">Popular Dishes</h2>

        <div class="popular__container container grid">
            @foreach($menus as $menu)
            <article class="popular__card">
                @if($menu->image)
                    <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="popular__img">
                @else
                    <img src="{{ asset('path/to/default-image.jpg') }}" alt="Default Image" class="popular__img">
                @endif

                <h3 class="popular__name">{{ $menu->name }}</h3>
                <span class="popular__description">{{ $menu->description }}</span>
                <span class="popular__price">$ {{ $menu->price }}</span>

                <button class="popular__button">
                    <i class="ri-shopping-bag-line"></i>
                </button>
            </article>
            @endforeach
        </div>
    </section>
@endsection