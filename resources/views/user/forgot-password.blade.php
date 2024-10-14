@extends('components.layout')

@section('title', 'Home page')

@section('content')
    <div class="container mt-5">
        <div class="row mb-5 m">
            <div class="col-md-6 offset-md-3">
                <h1 class="h2 text-center mb-4 mt-5">Forgot password</h1>
                <h5 class="text-center mb-4">Enter your email to receive a password reset link.</h5>

                <form action="{{ route('password.email') }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input
                            name="email"
                            type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            id="email"
                            placeholder="Email"
                            value="{{ old('email') }}">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Send</button>
                </form>
            </div>
        </div>
    </div>
@endsection
