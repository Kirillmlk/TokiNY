@extends('components.layout')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center">Order placement</h1>

        <form action="{{ route('order.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', auth()->user()->name) }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone number</label>
                <input type="tel" name="phone" class="form-control" value="{{ old('phone', auth()->user()->phone) }}" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Delivery address</label>
                <input type="text" name="address" class="form-control" value="{{ old('address') }}" required>
            </div>
            <button type="submit" class="btn btn-success">Confirm order</button>
        </form>
    </div>
@endsection
