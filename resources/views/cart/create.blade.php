@extends('components.layout')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center">Оформление заказа</h1>

        <form action="{{ route('order.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Имя</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', auth()->user()->name) }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Номер телефона</label>
                <input type="tel" name="phone" class="form-control" value="{{ old('phone', auth()->user()->phone) }}" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Адрес доставки</label>
                <input type="text" name="address" class="form-control" value="{{ old('address') }}" required>
            </div>
            <button type="submit" class="btn btn-success">Подтвердить заказ</button>
        </form>
    </div>
@endsection
