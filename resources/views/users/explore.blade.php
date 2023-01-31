@extends('users.template.header')

@section('title')
    Explore Product
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/user/product.css') }}">
@endsection

@section('content')
    {{-- {{dd(request()->search)}} --}}
    <div class="content-header explore">
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
                <a href="{{ route('product.index') }}">
                    <img src="{{ asset('imgAsset/woodka-png.png') }}" alt="">
                </a>
            </div>
            <div class="text">
                @if (request()->search != null)
                    <h1>{{ count($product) }} Result For "{{ request()->search }}"</h1>
                @else
                    <h1>Explore Product in WoodKa Watch</h1>
                @endif
            </div>
            <div class="search">
                <input value="{{ old('search', request()->search) }}" type="text" id="searchProduct"
                    placeholder="Search Product">
                <button id="submitSearch" onclick="search()"><i class='bx bx-search-alt'></i></button>
            </div>
        </div>
    </div>
    <div class="content-main">
        <div id="main" class="roww filter">
            <div class="header-filter">
                <select name="filterByKategory" id=""
                    onchange="return window.location.href = '{{ route('product.index') }}?categories='+this.value+''">
                    <option value="all" {{ request()->categories == 'all' ? 'selected' : '' }}>All Product</option>
                    @foreach ($category as $cate)
                        <option value="{{ $cate->id }}" {{ request()->categories == $cate->id ? 'selected' : '' }}>
                            {{ $cate->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="roww product">
            @if (!count($product))
                <div class="card-empty">
                    <h1>No Product Found</h1>
                    <i class="fa-solid fa-face-dizzy"></i>
                </div>
            @endif
            <div class="card-wrapper">
                @foreach ($product as $p)
                    {{-- {{dd($p)}} --}}
                    {{-- {{ dd( $p->product_image->pluck('image')) }} --}}

                    <div class="cardd">
                        <div class="img-header"
                            onclick="return window.location.href='{{ url('timepiece/product/' . $p->name . '/' . $p->id . '') }}'">
                            <img src="{{ asset('imageProduct/' . implode(', ', $p->product_image->pluck('image')->toArray())) }}"
                                alt="">
                        </div>
                        <div class="body-card"
                            onclick="return window.location.href='{{ url('timepiece/product/' . $p->name . '/' . $p->id . '') }}'">
                            <div class="product-name">
                                <span>{{ $p->name }}</span>
                            </div>
                            <div class="product-price">
                                <span>IDR {{ number_format($p->price, '2', ',', '.') }}</span>
                            </div>
                        </div>
                        <div class="footer-card">
                            <div class="verdict">
                                <i class="fa-solid fa-star"></i>
                                <span>4.5</span>
                            </div>
                            <form id="submitCart{{ $p->id }}" action="{{ route('cart.store') }}" method="POST">
                                @csrf
                                <div onclick="SubmitCart({{ $p->id }})" class="add-cart">
                                    @if (Route::has('login'))
                                        @auth
                                            <input type="hidden" id="1" value="{{ old('quantity', 1) }}"
                                                min="1" name="quantity">
                                            <input type="hidden" name="user_id" id="" value="{{ Auth::user()->id }}">
                                            <input type="hidden" name="product_id" value="{{ $p->id }}">
                                        @endauth
                                    @endif
                                    <i class="fa-solid fa-cart-plus"></i>
                                    <span>Add to Cart</span>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function ScrollToBott() {
            document.getElementById("main").scrollIntoView()
        }

        function SubmitCart(id) {
            document.getElementById("submitCart" + id).submit();
        }

        var input = document.getElementById("searchProduct");
        input.addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
                document.getElementById("submitSearch").click();
            }
        });

        function search() {
            var valueSearch = document.getElementById('searchProduct').value
            window.location.href = '{{ route('product.index') }}?search=' + valueSearch + '';
        }
    </script>
@endsection
