@extends('components.layout')

@section('content')
    <div class="container">
        <h1>Заказ успешно оформлен!</h1>
        <p>Спасибо за ваш заказ. Мы свяжемся с вами в ближайшее время для подтверждения.</p>
        <a href="{{ route('menu.show') }}" class="btn btn-primary">Вернуться к меню</a>
    </div>
@endsection
