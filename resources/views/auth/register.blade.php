{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- phone -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="number" name="phone" :value="old('phone')" required />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}


@extends('auth.template-auth')

@section('title')
    Sign Up
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/auth/sign-up.css') }}">
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
            <div class="header-title">
                <span>Sign Up</span>
            </div>
            <form class="form-login" action="{{ route('register') }}" method="POST">
                @csrf
                {{-- name --}}
                <div class="form-grp">
                    <label for="">Name</label>
                    <input class="inp @error('name') is-invalid @enderror" type="text" name="name"
                        placeholder="Enter Name" value="{{old('name')}}" required autofocus>
                    @error('name')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
                {{-- email --}}
                <div class="form-grp">
                    <label for="">Email</label>
                    <input class="inp @error('email') is-invalid @enderror" type="email" name="email"
                        placeholder="Enter Email" value="{{old('email')}}" required>
                    @error('email')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
                {{-- phone --}}
                <div class="form-grp">
                    <label for="">Phone</label>
                    <input class="inp @error('phone') is-invalid @enderror" type="number" name="phone"
                        placeholder="Enter Phone" value="{{old('phone')}}" required>
                    @error('phone')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
                {{-- password --}}
                <div class="form-grp">
                    <label for="">Password</label>
                    <input class="inp @error('password') is-invalid @enderror" type="password" name="password"
                        placeholder="Enter Password" value="{{old('password')}}" required>
                    @error('password')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
                {{-- confirm password --}}
                <div class="form-grp">
                    <label for="">Confirm Password</label>
                    <input class="inp @error('password_confirmation') is-invalid @enderror" type="password"
                        name="password_confirmation" placeholder="Enter Confirm Password"
                        value="{{old('password_confirmation')}}">
                    @error('password_confirmation')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
                <div class="form-butt">
                    <button class="sign-up">Sign Up</button>
                    @if (Route::has('login'))
                        <a class="already-regis" href="{{ route('login') }}">
                            {{ __('Already Registered?') }}
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </section>
@endsection
