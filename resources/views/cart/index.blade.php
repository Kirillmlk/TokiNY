@extends('components.layout')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center">Ваша корзина</h1>
        @if ($cartItems->isEmpty())
            <p class="text-center">Ваша корзина пуста.</p>
        @else
            <div class="row">
                @foreach ($cartItems as $item)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{ asset('storage/' . $item->menu->image) }}" class="card-img-top" alt="{{ $item->menu->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->menu->name }}</h5>
                                <p class="card-text">Цена: {{ $item->menu->price }} ₽</p>
                                <p class="card-text">Количество: {{ $item->quantity }}</p>
                                <form action="{{ route('cart.remove', $item->menu->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Удалить из корзины</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center">
                <p><strong>Общая сумма: {{ $totalPrice }} ₽</strong></p>
                <form action="{{ route('order.create') }}" method="GET">
                    <button type="submit" class="btn btn-primary">Оформить заказ</button>
                </form>
            </div>
        @endif
    </div>
@endsection
