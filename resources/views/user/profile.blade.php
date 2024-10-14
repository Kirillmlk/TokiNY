@extends('components.layout')

@section('title', 'Profile')

@section('content')
    <div class="container mt-5">
        <h1 class="h2 text-center mb-4">Profile</h1>

        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card cream-background text-dark">
                    <div class="card-header text-center">
                        <h5 class="mb-0">User Information</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
                        <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                        <p><strong>Phone Number:</strong> {{ auth()->user()->phone_number ?? 'Not provided' }}</p>
                        <p><strong>Address:</strong> {{ auth()->user()->address ?? 'Not provided' }}</p>
                        <p><strong>Joined on:</strong> {{ auth()->user()->created_at->format('d M, Y') }}</p>
                    </div>
                    <div class="card-footer text-center">
                        @if (is_null(auth()->user()->phone_number) || is_null(auth()->user()->address))
                            <a href="{{ route('profile.edit') }}" class="btn btn-success">
                                Enter Phone and Address for Quick Order
                            </a>
                        @else
                            <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <a href="{{ route('logout') }}" class="btn btn-danger"
                               onclick="return confirm('Are you sure you want to log out?')">Logout</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
