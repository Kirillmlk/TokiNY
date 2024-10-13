@extends('components.layout')

@section('content')
    <div class="container">
        <h1>Оформление заказа</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Ваши товары в корзине:</h5>

                @if (count($cartItems ?? []) > 0)
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Название</th>
                            <th>Цена</th>
                            <th>Количество</th>
                            <th>Сумма</th>
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
                            <label for="address">Адрес доставки</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Телефон</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Подтвердить заказ</button>
                    </form>
                @else
                    <p>Ваша корзина пуста.</p>
                    <a href="{{ route('menu.show') }}" class="btn btn-secondary">Вернуться к меню</a>
                @endif
            </div>
        </div>
    </div>
@endsection


