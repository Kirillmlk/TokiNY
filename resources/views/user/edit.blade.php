@extends('components.layout')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center">Редактировать профиль</h1>
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Имя</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="mb-3">
                <label for="phone_number" class="form-label">Номер телефона</label>
                <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number', $user->phone_number) }}">
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Адрес</label>
                <textarea name="address" class="form-control">{{ old('address', $user->address) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        </form>
    </div>
@endsection
