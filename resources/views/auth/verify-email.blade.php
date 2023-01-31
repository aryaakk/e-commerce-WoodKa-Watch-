{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout> --}}

@extends('auth.template-auth')

@section('title')
    Verify Email
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/auth/verify-email.css') }}">
@endsection

@section('content')
    {{-- {{ dd(session('status')) }} --}}
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
                <span>Email Verification</span>
            </div>
            <div class="detail-verify">
                <span>A new verification link has been sent to the email address you provided during registration.</span>
            </div>
            @if (session('status') == 'verification-link-sent')
                <div class="message-success">
                    <i>{{ __('A new verification link has been sent to the email address you provided during registration.!!') }}</i>
                </div>
            @endif
            <form class="form-login" action="{{ route('verification.send') }}" method="POST">
                @csrf
                <div class="form-butt">
                    <button class="email-verify">Resend Verification Email</button>
                </div>
            </form>
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="logout">
                    {{ __('or Log Out') }}
                </button>
            </form>
        </div>
    </section>
@endsection
