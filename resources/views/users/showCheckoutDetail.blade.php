@extends('users.template.header')

@section('title')
    Checkout
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/user/checkout.css') }}">
@endsection

@section('content')
    {{-- {{dd($cart)}} --}}
    <div class="content-header">
        <div class="wrapper-detail">
            <div class="head">
                <div class="img">
                    <img src="{{ asset('imgAsset/woodka-png.png') }}" alt="">
                </div>
                <div class="text">
                    <span>CheckOut</span>
                </div>
            </div>
            <div class="action">
                <i class="fa-solid fa-arrow-left"></i>
                <a href="{{ route('cart.index') }}">Back To Cart</a>
            </div>
        </div>
    </div>
    <div class="content-main">
        <div class="address">
            <div class="header-address">
                <span>Delivery Address</span>
                <i class="fa-solid fa-location-dot"></i>
            </div>
            <div class="content-address">
                <div class="profile">
                    <span>{{ $user->name }}</span>
                    <span>{{ $user->phone }}</span>
                </div>
                <div class="user-address">
                    <span>{{ $user->alamat }}</span>
                </div>
                <div class="action">
                    <a href="">Ubah</a>
                </div>
            </div>
        </div>
        <div class="detail-product">
            <div class="header-detail">
                <span>Products Ordered</span>
                <div class="sub-menu">
                    <div class="unit-price">
                        <span>Unit Price</span>
                    </div>
                    <div class="quantity">
                        <span>Quantity</span>
                    </div>
                    <div class="sub-total-product">
                        <span>Sub Total Product</span>
                    </div>
                </div>
            </div>
            <form action="{{ route('order.store') }}" method="POST">
                @csrf
                <div class="product">
                    @foreach ($cart as $c)
                        @foreach ($c as $ct)
                            <input type="hidden" name="cart_id[]" id="cart_id" value="{{ $ct->id }}">
                            <input type="hidden" name="product_id[]" id="" value="{{ $ct->product->id }}">
                            <div class="list-product">
                                <div class="name-product">
                                    <div class="image">
                                        <img src="{{ asset('imageProduct/' . $ct->product->image) }}" alt="">
                                    </div>
                                    <span>{{ $ct->product->name }}</span>
                                </div>
                                <div class="detail-order">
                                    <div class="unit-price">
                                        <span>{{ number_format($ct->product->price, '2', ',', '.') }}</span>
                                    </div>
                                    <div class="quantity">
                                        <span>{{ $ct->quantity }}</span>
                                    </div>
                                    <div class="sub-total-product">
                                        <span>{{ number_format($ct->product->price * $ct->quantity, '2', ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
                <div class="total-pesanan">
                    <span class="orders-total">Orders Total ({{ count($cart) }} Product) : </span>
                    <span class="price-total">Rp {{ number_format($totalPrice, '2', ',', '.') }}</span>
                </div>
                <div class="butt">
                    <input type="hidden" name="delivery_addres" value="{{$user->alamat}}">
                    <input type="hidden" name="total_price" id="total_prices" value="{{ $totalPrice }}">
                    <button>Place an Order</button>
                </div>
            </form>
        </div>
    </div>
@endsection
