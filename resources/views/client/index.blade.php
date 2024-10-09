@extends('components.layout')

@section('content')
    <h1>Меню</h1>

    @foreach ($categories as $category)
        <h2>{{ $category->name }}</h2>

        <div class="row">
            @foreach ($category->menus as $menu)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">{{ $menu->name }}</h5>
                            <p class="card-text">{{ $menu->description }}</p>
                            <p><strong>Цена:</strong> {{ $menu->price }} руб.</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
@endsection
