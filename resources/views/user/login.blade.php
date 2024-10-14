@extends('components.layout')

@section('title', 'Login')

@section('content')
    <div class="container mt-5">
        <div class="row mb-5">
            <div class="col-md-6 offset-md-3">
                <h1 class="h2 mt-5 mb-5 text-center">Login Form</h1>
                <form action="{{ route('login.auth') }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email" value="{{ old('email') }}">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password">
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 form-check">
                        <input name="remember" class="form-check-input" type="checkbox" id="remember">
                        <label class="form-check-label" for="remember">
                            Remember me
                        </label>
                    </div>

                    <button type="submit" class="btn btn-success">Login</button>
                    <a href="{{ route('password.request') }}" class="ms-2">Forgot password?</a>
                </form>
            </div>
        </div>
    </div>
@endsection
