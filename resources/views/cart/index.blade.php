@extends('components.layout')

@section('content')

    <div class="container mt-5">
        <h1 class="text-center">Your cart</h1>

        @if ($cartItems && count($cartItems) > 0)
            <div class="row">
                @foreach ($cartItems as $item)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{ asset('storage/' . $item->menu->image) }}" class="card-img-top" alt="{{ $item->menu->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->menu->name }}</h5>
                                <p class="card-text">Price: {{ $item->menu->price }} ₽</p>
                                <p class="card-text">Quantity: {{ $item->quantity }}</p>
                                <form action="{{ route('cart.remove', $item->menu->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Remove from cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center">
                <p><strong>Общая сумма: {{ $totalPrice }} ₽</strong></p>
                <form action="{{ route('order.create') }}" method="GET">
                    <button type="submit" class="btn btn-primary">Place order</button>
                </form>
            </div>
        @else
            <p class="text-center">Your cart is empty</p>
            <p class="text-center">You can visit our menu to choose the dish that suits you</p>
        @endif
    </div>

@endsection
