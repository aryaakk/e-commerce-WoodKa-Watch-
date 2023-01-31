{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}


@extends('auth.template-auth')

@section('title')
    Forgot Password
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/auth/forgot-password.css') }}">
@endsection

@section('content')
    {{-- {{dd(session('status'))}} --}}
    <section class="containerr">
        <svg xmlns="http://www.w3.org/2000/svg" class="svg-bubbles" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
            xmlns:svgjs="http://svgjs.dev/svgjs" viewBox="0 0 800 450" opacity="1">
            <defs>
                <filter id="bbblurry-filter" x="-100%" y="-100%" width="400%" height="400%"
                    filterUnits="objectBoundingBox" primitiveUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                    <feGaussianBlur stdDeviation="45" x="0%" y="0%" width="100%" height="100%"
                        in="SourceGraphic" edgeMode="none" result="blur"></feGaussianBlur>
                </filter>
            </defs>
            <g filter="url(#bbblurry-filter)">
                <ellipse rx="96" ry="98.5" cx="334.09649658203125" cy="229.61070251464844"
                    fill="hsla(31, 100%, 35%, 1.00)"></ellipse>
                <ellipse rx="96" ry="98.5" cx="436.64039750532675" cy="159.88685607910156"
                    fill="hsla(28, 40%, 39%, 1.00)"></ellipse>
                <ellipse rx="96" ry="98.5" cx="497.6194555109198" cy="277.70458429509944"
                    fill="hsla(28, 56%, 72%, 1.00)"></ellipse>
            </g>
        </svg>
        <div class="wrapper">
            {{-- <div class="img-header">
                <img src="{{ asset('imgAsset/logo-footer.jpg') }}" alt="">
    </div> --}}
            <div class="header-title">
                <span>Forgot Password??</span>
            </div>
            <div class="detail-forgot">
                <span>Forgot your password? No problem. Just let us know your email address and we will email you a password
                    reset link that will allow you to choose a new one.</span>
            </div>
            @if (session('status') == 'Email-Send')
                <div class="message-success">
                    <i>{{ __('Email Reset Password Has Been Send to Your Email') }}</i>
                </div>
            @endif
            <form class="form-login" action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="form-grp">
                    <label for="">Email</label>
                    <input class="inp @error('email') is-invalid @enderror" type="email" name="email"
                        placeholder="Enter Email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <div class="invalid-feedback message-retry">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
                <div class="form-butt">
                    <button class="email-reset">Email Password Reset Link</button>
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="sign-in">or Sign In</a>
                    @endif
                </div>
            </form>
        </div>
    </section>
@endsection
