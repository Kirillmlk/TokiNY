@extends('components.layout')

@section('title', 'Verify Email')

@section('content')
    <div class="content">
        <div class="alert alert-info mt-5" role="alert">
            Thank you for signing up! Please check your email for a verification link.
        </div>
        <div>
            Didn't receive the link? Click the button to resend the link and try again.
            <form action="{{ route('verification.send') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-link ps-0">Send link</button>
            </form>
        </div>
        @include('components.about')
    </div>
@endsection


