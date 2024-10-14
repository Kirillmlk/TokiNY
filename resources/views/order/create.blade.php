@extends('components.layout')

@section('content')
    <div class="container">
        <h1>Order processing</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Your items in the cart:</h5>

                @if (count($cartItems ?? []) > 0)
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $totalPrice = 0; @endphp
                        @foreach ($cartItems as $item)
                            @php
                                $itemTotal = $item->menu->price * $item->quantity;
                                $totalPrice += $itemTotal;
                            @endphp
                            <tr>
                                <td>{{ $item->menu->name }}</td>
                                <td>{{ $item->menu->price }} $</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $itemTotal }} $</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <h5 class="mt-3">Общая сумма: {{ $totalPrice }} ₽</h5>

                    <form action="{{ route('order.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="address">Delivery address</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $address ?? '') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone number</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $userPhone ?? '+375') }}" maxlength="13" required>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Confirm order</button>
                    </form>
                @else
                    <p>Ваша корзина пуста.</p>
                    <a href="{{ route('menu.show') }}" class="btn btn-secondary">Return to menu</a>
                @endif
            </div>
        </div>
    </div>
@endsection
