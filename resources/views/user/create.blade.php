@extends('components.layout')

@section('title', 'Create')

@section('content')
    <div class="row mb-5 mt-5">
        <div class="col-md-6 offset-md-3 pt-5 ">
            <h1 class="h2 text-center">Register form</h1>
            <p class="mb-4 mt-5 text-center">Register to place your first order and receive notifications about
                promotions and discounts</p>

            <form action="{{ route('user.store') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror " id="name"
                           placeholder="Name" value="{{ old('name') }}">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror"
                           id="email" placeholder="Email" value="{{ old('email') }}">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror"
                           id="password" placeholder="Password">
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input name="password_confirmation" type="password" class="form-control" id="password_confirmation"
                           placeholder="Confirm Password">
                </div>

                <button type="submit" class="btn btn-primary">Register</button>
                <a href="{{ route('login') }}" class="ms-3">Already registered?</a>

            </form>
        </div>
    </div>
@endsection
