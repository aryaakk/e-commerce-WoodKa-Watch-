{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
@csrf

<!-- Email Address -->
<div>
    <x-input-label for="email" :value="__('Email')" />
    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
    <x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>

<!-- Password -->
<div class="mt-4">
    <x-input-label for="password" :value="__('Password')" />

    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />

    <x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>

<!-- Remember Me -->
<div class="block mt-4">
    <label for="remember_me" class="inline-flex items-center">
        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
    </label>
</div>

<div class="flex items-center justify-end mt-4">
    @if (Route::has('password.request'))
    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
        {{ __('Forgot your password?') }}
    </a>
    @endif

    <x-primary-button class="ml-3">
        {{ __('Log in') }}
    </x-primary-button>
    <a href="{{ 'login/google/redirect' }}" class="btn btn-danger">Login With Google</a>
</div>
</form>
</x-guest-layout>
--}}


@extends('auth.template-auth')

@section('title')
    Login
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endsection

@section('content')
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
                <span>Log In</span>
            </div>
            <form class="form-login" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-grp">
                    <label for="">Email</label>
                    <input class="inp @error('email') is-invalid @enderror" type="email" name="email"
                        placeholder="Enter Email" value="{{old('email')}}" required autofocus>
                    @error('email')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
                <div class="form-grp">
                    <label for="">Password</label>
                    <input class="inp  @error('password') is-invalid @enderror" type="password" name="password"
                        placeholder="Enter Password" value="{{old('password')}}" required>
                    @error('password')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
                <div class="form-grp remember">
                    <input class="check" type="checkbox" name="remember">
                    <span>Remember Me</span>
                </div>
                <div class="form-butt">
                    <button class="log-in">Log In</button>
                    <div class="sign-with">
                        <a class="google" href="{{ 'login/google/redirect' }}"><i class="fa-brands fa-google"></i> Use
                            Google Account</a>
                    </div>
                    @if (Route::has('password.request'))
                        <a class="forgot-password" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="sign-up">Sign Up</a>
                    @endif
                </div>
            </form>
        </div>
    </section>
@endsection
