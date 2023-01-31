@extends('users.template.header')

@section('title')
    {{ $title }}
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/user/product.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('js/magiczoomplus-trial/magiczoomplus/magiczoomplus.css') }}">
    <script type="text/javascript" src="{{ asset('js/magiczoomplus-trial/magiczoomplus/magiczoomplus.js') }}"></script>
@endsection

@section('content')
    <div class="content-detail">
        <div class="detail-wrapper">
            <div class="coll image">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach ($product_images as $key => $keyy)
                            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}"
                                class="<?php
                                if ($keyy->is_primary == 1) {
                                    echo 'active';
                                } else {
                                    echo '';
                                }
                                ?> bg-dark"></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner inner">
                        @foreach ($product_images as $images)
                            <div class="carousel-item item <?php
                            if ($images->is_primary == 1) {
                                echo 'active';
                            } else {
                                echo '';
                            }
                            ?>">
                                <a href="{{ asset('imageProduct/' . $images->image) }}" class="MagicZoom"
                                    data-options="zoomPosition: inner"><img
                                        src="{{ asset('imageProduct/' . $images->image) }}" class="d-block w-100"
                                        alt="...">
                                </a>

                            </div>
                        @endforeach
                    </div>
                    {{-- <button class="carousel-control-prev bg-dark" type="button" data-target="#carouselExampleIndicators"
                        data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </button>
                    <button class="carousel-control-next bg-dark" type="button" data-target="#carouselExampleIndicators"
                        data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </button> --}}
                </div>
            </div>
            <div class="coll detail-product">
                <div class="category-name">
                    <span>{{ $category->name_category }}</span>
                </div>
                <div class="product-name">
                    <span>{{ $timepiece->name }}</span>
                </div>
                <div class="verdict-reviews">
                    <div class="verdict">
                        <i class="fa-solid fa-star"></i>
                        <span>0</span>
                    </div>
                    <div class="row-vert"></div>
                    <div class="reviews">
                        <span>0 Reviews</span>
                    </div>
                </div>
                <div class="product-price">
                    <span>IDR {{ number_format($timepiece->price, '2', ',', '.') }}</span>
                </div>
                <div class="description">
                    <div class="header-description">
                        <span>Description Product : </span>
                    </div>
                    <div class="content-description">
                        {!! $timepiece->description !!}
                    </div>
                </div>
            </div>
            <div class="coll summary-order">
                <div class="card-summary-order">
                    <div class="header-summary">
                        <span>Product Summary</span>
                    </div>
                    <hr class="row-header">
                    <form action="{{ route('cart.store') }}" method="POST">
                        @csrf
                        <div class="content-summary">
                            <div class="quantity">
                                <span>Quantity<span class="stock">(stock:{{ $timepiece->stock }})</span></span>
                                <div class="input-quan">
                                    <button type="button" id="sub" class="sub"><i
                                            class="fa-solid fa-minus"></i></button>
                                    <input class="count" type="text  " id="1" value="{{ old('quantity', 1) }}"
                                        min="1" max="{{ $timepiece->stock }}" name="quantity" />
                                    <button type="button" id="add" class="add"><i
                                            class="fa-solid fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="weight">
                                <span>Weight</span>
                                <span class="num-weight">{{ number_format($timepiece->weight, '0', ',', '.') }}</span>
                            </div>
                            <div class="unit">
                                <span>Unit(weight)</span>
                                <span class="num-unit">{{ $timepiece->unit }}</span>
                            </div>
                        </div>
                        <hr class="row-content">
                        <div class="add-to-cart">
                            @if (Route::has('login'))
                                @auth
                                    <input type="hidden" name="user_id" id="" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="product_id" value="{{ $timepiece->id }}">
                                @endauth
                            @endif
                            <button class="cart">Add To Cart</button>
                        </div>
                    </form>
                    <form action="">
                        <div class="buy-now">
                            <button class="buy">Buy Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var max = parseInt('{{ $timepiece->stock }}');
        console.log(max);
        $("#sub").click(function() {
            var th = $(".count")
            if (th.val() > 1) {
                th.val(+th.val() - 1);
            }
            console.log('a')
        })
        $("#add").click(function() {
            var th = $(".count")
            if (th.val() >= max) {
                console.log(max)
                th.val(max)
                $('#add').prop('disabled', true);
            } else {
                th.val(+th.val() + 1);
            }
        })
    </script>
@endsection
