@extends('components.layout')

@section('content')
    <div class="container">
        <h1>Order has been successfully placed!</h1>
        <p>Thank you for your order. We will contact you shortly for confirmation.</p>
        <a href="{{ route('menu.show') }}" class="btn btn-primary">Return to menu</a>
    </div>
@endsection
