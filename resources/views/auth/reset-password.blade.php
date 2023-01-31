{{-- <x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
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
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

@extends('auth.template-auth')

@section('title')
    Reset Password
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/auth/reset-password.css') }}">
@endsection

@section('content')
    {{-- {{dd($request->email)}} --}}
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
                <span>Reset Password</span>
            </div>
            <form class="form-login" action="{{ route('password.store') }}" method="POST">
                @csrf
                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                {{-- email --}}
                <div class="form-grp">
                    <label for="">Email</label>
                    <input class="inp @error('email') is-invalid @enderror" type="email" name="email"
                        placeholder="Enter Email" value="{{ old('email', $request->email) }}" required>
                    @error('email')
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
                    <button class="reset-pass">Reset Password</button>
                </div>
            </form>
        </div>
    </section>
@endsection
