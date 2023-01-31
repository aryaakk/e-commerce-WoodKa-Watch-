@extends('users.template.header')

@section('title')
    Home
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/user/home.css') }}">
@endsection

@section('content')
    <div class="content-header">
        <svg class="svg-bubbles-background" xmlns="http://www.w3.org/2000/svg" version="1.1"
            xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs" viewBox="0 0 800 800"
            opacity="1">
            <defs>
                <filter id="bbblurry-filter" x="-100%" y="-100%" width="400%" height="400%"
                    filterUnits="objectBoundingBox" primitiveUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                    <feGaussianBlur stdDeviation="81" x="0%" y="0%" width="100%" height="100%"
                        in="SourceGraphic" edgeMode="none" result="blur"></feGaussianBlur>
                </filter>
            </defs>
            <g filter="url(#bbblurry-filter)">
                <ellipse rx="127" ry="126.5" cx="0.38605878740082744" cy="302.26500825732165" fill="#f09134ff">
                </ellipse>
                <ellipse rx="127" ry="126.5" cx="181.55035408379524" cy="425.3773131045996" fill="#ed862b">
                </ellipse>
                <ellipse rx="127" ry="126.5" cx="8.65548050965316" cy="544.8819656771516" fill="#dc5713">
                </ellipse>
            </g>
        </svg>
        <svg class="svg-bubbles-small" viewbox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <path
                d="
                M 0, 50.5
                C 0, 27.775000000000002 27.775000000000002, 0 50.5, 0
                S 101, 27.775000000000002 101, 50.5
                    73.225, 101 50.5, 101
                    0, 73.225 0, 50.5
            "
                fill="#FADB5F"
                transform="rotate(
                12,
                100,
                100
            ) translate(
                49.5
                49.5
            )">
            </path>
        </svg>
        <div class="hero-image">
            <img src="{{ asset('imgAsset/timepiece-header.jpg') }}" alt="">
        </div>
        <div class="hero-text">
            <svg class="svg-bubbles-back-herotext" xmlns="http://www.w3.org/2000/svg" version="1.1"
                xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs" viewBox="0 0 800 800"
                opacity="1">
                <defs>
                    <filter id="bbblurry-filter" x="-100%" y="-100%" width="400%" height="400%"
                        filterUnits="objectBoundingBox" primitiveUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                        <feGaussianBlur stdDeviation="87" x="0%" y="0%" width="100%" height="100%"
                            in="SourceGraphic" edgeMode="none" result="blur"></feGaussianBlur>
                    </filter>
                </defs>
                <g filter="url(#bbblurry-filter)">
                    <ellipse rx="127" ry="126.5" cx="488.3441226020534" cy="349.3854675292969" fill="#5e2404ff">
                    </ellipse>
                    <ellipse rx="127" ry="126.5" cx="324.73338309882206" cy="512.8363113802765"
                        fill="hsla(24, 87%, 35%, 1.00)"></ellipse>
                    <ellipse rx="127" ry="126.5" cx="319.9558423426763" cy="348.6746902865265"
                        fill="hsla(44, 98%, 77%, 1.00)"></ellipse>
                    <ellipse rx="127" ry="126.5" cx="489.6440544727584" cy="517.4059373146576"
                        fill="hsla(30, 65%, 56%, 1.00)"></ellipse>
                </g>
            </svg>
            <div class="img">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('user.index') }}">
                            <img src="{{ asset('imgAsset/woodka-png.png') }}" alt="">
                        </a>
                    @else
                        <a href="{{ route('guest.index') }}">
                            <img src="{{ asset('imgAsset/woodka-png.png') }}" alt="">
                        </a>
                    @endauth
                @endif
            </div>
            <div class="text">
                <h1>Choose your favorite watch at WoodKa Watch</h1>
                <span>In Woodka Watch, you can choose as many different clocks from WoodKa Watch as you like</span>
                <form action="{{route('product.index')}}" method="GET">
                    @csrf
                    <button class="shop-now">Shop Now</button>
                </form>
            </div>
        </div>
    </div>
    <div class="content-main">
        <div class="roww crd">
            <div class="cardd">
                <div class="head-icon">
                    <i class="fi fi-sr-star-comment-alt"></i>
                </div>
                <div class="content-card">
                    <div class="title">
                        <span>WARRANTY & SERVICE</span>
                    </div>
                    <div class="cont">
                        <span>Your timepiece is warranted against defect in materials and craftsmanship by WOODKA watch
                            under the terms and conditions of this warranty.</span>
                    </div>
                </div>
            </div>
            <div class="cardd">
                <div class="head-icon">
                    <i class="fi fi-sr-star-comment-alt"></i>
                </div>
                <div class="content-card">
                    <div class="title">
                        <span>WARRANTY & SERVICE</span>
                    </div>
                    <div class="cont">
                        <span>Your timepiece is warranted against defect in materials and craftsmanshi.</span>
                    </div>
                </div>
            </div>
            <div class="cardd">
                <div class="head-icon">
                    <i class="fi fi-sr-star-comment-alt"></i>
                </div>
                <div class="content-card">
                    <div class="title">
                        <span>WARRANTY & SERVICE</span>
                    </div>
                    <div class="cont">
                        <span>Your timepiece is warranted against defect in materials and craftsmanship by WOODKA watch
                            under the terms and conditions of this warranty.</span>
                    </div>
                </div>
            </div>
            <div class="cardd">
                <div class="head-icon">
                    <i class="fi fi-sr-star-comment-alt"></i>
                </div>
                <div class="content-card">
                    <div class="title">
                        <span>WARRANTY & SERVICE</span>
                    </div>
                    <div class="cont">
                        <span>Your timepiece is warranted against defect in materials and craftsmanship by WOODKA watch
                            under the terms and conditions of this warranty.</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="roww timepiece">
            <svg class="svg-timepiece" xmlns="http://www.w3.org/2000/svg" version="1.1"
                xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs" viewBox="0 0 800 800"
                opacity="0.81">
                <defs>
                    <filter id="bbblurry-filter" x="-100%" y="-100%" width="400%" height="400%"
                        filterUnits="objectBoundingBox" primitiveUnits="userSpaceOnUse"
                        color-interpolation-filters="sRGB">
                        <feGaussianBlur stdDeviation="95" x="0%" y="0%" width="100%" height="100%"
                            in="SourceGraphic" edgeMode="none" result="blur"></feGaussianBlur>
                    </filter>
                </defs>
                <g filter="url(#bbblurry-filter)">
                    <ellipse rx="150" ry="150" cx="401.31484857529244" cy="426.6174378719629"
                        fill="#da7e37ff"></ellipse>
                    <ellipse rx="150" ry="150" cx="401.506453588995" cy="337.07294356261247"
                        fill="hsla(27, 100%, 16%, 1.00)"></ellipse>
                    <ellipse rx="150" ry="150" cx="398.2352449906434" cy="228.91067648682917"
                        fill="hsla(26, 100%, 88%, 1.00)"></ellipse>
                </g>
            </svg>
            <div class="title">
                <span>TimePiece</span>
                <small>Every timepiece has it's own character. Choose that represent you.</small>
            </div>
            <div class="content">
                <div class="left">
                    <img src="{{ asset('imgAsset/timepiece-home.jpg') }}" alt="">
                </div>
                <div class="right">
                    <div class="card-wrapper">
                        <div class="cardd">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="roww straps">
            <svg class="svg-straps" xmlns="http://www.w3.org/2000/svg" version="1.1"
                xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs" viewBox="0 0 800 800"
                opacity="0.81">
                <defs>
                    <filter id="bbblurry-filter" x="-100%" y="-100%" width="400%" height="400%"
                        filterUnits="objectBoundingBox" primitiveUnits="userSpaceOnUse"
                        color-interpolation-filters="sRGB">
                        <feGaussianBlur stdDeviation="95" x="0%" y="0%" width="100%" height="100%"
                            in="SourceGraphic" edgeMode="none" result="blur"></feGaussianBlur>
                    </filter>
                </defs>
                <g filter="url(#bbblurry-filter)">
                    <ellipse rx="150" ry="150" cx="401.31484857529244" cy="426.6174378719629"
                        fill="#da7e37ff"></ellipse>
                    <ellipse rx="150" ry="150" cx="401.506453588995" cy="337.07294356261247"
                        fill="hsla(27, 100%, 16%, 1.00)"></ellipse>
                    <ellipse rx="150" ry="150" cx="398.2352449906434" cy="228.91067648682917"
                        fill="hsla(26, 100%, 88%, 1.00)"></ellipse>
                </g>
            </svg>
            <div class="title">
                <span>Straps</span>
                <small>Personalized your style with our interchangeable straps.</small>
            </div>
            <div class="content">
                <div class="left">
                </div>
                <div class="right">
                    <img src="{{ asset('imgAsset/straps-home.jpg') }}" alt="">
                </div>
            </div>
        </div>
    </div>
@endsection
