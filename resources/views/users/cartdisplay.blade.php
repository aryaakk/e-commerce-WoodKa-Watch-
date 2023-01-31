@extends('users.template.header')

@section('title')
    Cart
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/user/cart.css') }}">
@endsection

@section('content')
    {{-- {{dd($cart->product->image)}} --}}
    <div class="content-cart">
        <div class="cart">
            <div class="header-cart">
                <span class="title">Your Shopping Cart</span>
                <a href="{{ route('timepiece') }}">Continue Shopping</a>
            </div>
            <div class="main-cart">
                <div class="list-cart">
                    <div class="header-list-cart">
                        <div class="image-product-name-category">
                            <div class="image">
                                <span>Image</span>
                            </div>
                            <div class="name-product-category">
                                <span>Product Name</span>
                            </div>
                        </div>
                        <div class="detail-cart">
                            <div class="price-product">
                                <span>Unit Price</span>
                            </div>
                            <div class="quantity-product">
                                <span>Quantity</span>
                            </div>
                            <div class="total-price">
                                <span>Total Price</span>
                            </div>
                            <div class="remove">
                                <span>Action</span>
                            </div>
                        </div>
                    </div>
                    @forelse ($carts as $c)
                        <div class="cart-row">
                            <div class="image-product-name-category">
                                <div class="image">
                                    <img src="{{ asset('imageProduct/' . $c->product->image) }}" alt="">
                                </div>
                                <div class="name-product-category">
                                    <span class="name-product">{{ $c->product->name }}</span>
                                    {{-- <span class="name-category">{{ $c->product->name }}</span> --}}
                                    <span class="name-category">{{ $c->product->name_category }}</span>
                                </div>
                            </div>
                            <div class="detail-cart">
                                <div class="price-product">
                                    <span>Rp{{ number_format($c->product->price, '0', ',', '.') }}</span>
                                </div>
                                <div class="quantity-product">
                                    <form action="{{ route('cart.update', $c->id) }}?quantity=reduce" method="POST">
                                        @csrf
                                        @method('patch')
                                        <input type="hidden" name="product_id" value="{{$c->product->id}}">
                                        <button type="submit" id="sub" class="sub"><i
                                                class="fa-solid fa-minus"></i></button>
                                    </form>
                                    <input class="count" type="text" id="1"
                                        value="{{ old('quantity', $c->quantity) }}" min="1" max="100"
                                        name="quantity" />
                                    <form action="{{ route('cart.update', $c->id) }}?quantity=plus" method="post">
                                        @csrf
                                        @method('patch')
                                        <input type="hidden" name="product_id" value="{{$c->product->id}}">
                                        <button type="submit" id="add" class="add"><i
                                                class="fa-solid fa-plus"></i></button>
                                    </form>
                                </div>
                                <div class="total-price">
                                    <span>Rp<span
                                            class="num">{{ number_format($c->product->price * $c->quantity, '0', ',', '.') }}</span></span>
                                </div>
                                <div class="remove">
                                    <form action="{{ route('cart.destroy', $c->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button><i class="fa-solid fa-trash-can"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
                <div class="order-summary">
                    <div class="card-order-summary">
                        <div class="header-card">
                            <span>Order Summary</span>
                        </div>
                        <hr>
                        <form action="{{ route('checkout.detail') }}" method="POST">
                            @csrf
                            <div id="cart_list_order" class="cart-list-order">
                                @foreach ($carts as $key => $c)
                                    <div id="listorder" class="list">
                                        <input type="hidden" name="cart_id[]" id="cart_id" value="{{ $c->id }}">
                                        <input type="hidden" name="product_id[]" id=""
                                            value="{{ $c->product->id }}">
                                        <input type="hidden" name="user_id" id="" value="{{ $c->user_id }}">
                                        <div class="header-list">
                                            <div class="img">
                                                <img src="{{ asset('imageProduct/' . $c->product->image) }}"
                                                    alt="">
                                            </div>
                                            <div class="name-product">
                                                <span>
                                                    <?php
                                                    if (strlen($c->product->name) >= 12) {
                                                        echo substr($c->product->name, 0, 12) . '...';
                                                    } else {
                                                        echo $c->product->name;
                                                    }
                                                    ?></span>
                                            </div>
                                        </div>
                                        <div class="detail-list">
                                            <div class="count">
                                                <div class="price">
                                                    <span
                                                        id="pricelist{{ $key }}">{{ number_format($c->product->price, '0', ',', '.') }}</span>
                                                </div>
                                                <div class="count-product">
                                                    <span>x<span
                                                            id="quantitylist{{ $key }}">{{ $c->quantity }}</span></span>
                                                </div>
                                            </div>
                                            <div class="remove">
                                                <button id="remove"><i class="fa-solid fa-xmark"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <hr>
                            <div class="total">
                                <span>Total : </span>
                                <span class="price"><span id="pricetotal"></span></span>
                            </div>
                            <hr>
                            <div class="checkout">
                                <input type="hidden" name="total_price" id="total_prices">
                                <button><span class="now">Checkout Now</span><span>Checkout</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            var pricelist
            var quantitylist
            var totalPrice = 0;
            var parentList = document.getElementById('cart_list_order').childElementCount;
            $("body").on("click", "#remove", function() {
                $(this).parents("#listorder").remove();
                var parentList = document.getElementById('cart_list_order').childElementCount;
                var totalPrice = 0;
                console.log(parentList)
                var resultPriceTotal = new Array();
                for (var i = 0; i < parentList; i++) {
                    pricelist = $('#pricelist' + i).text();
                    console.log(pricelist)
                    quantitylist = $('#quantitylist' + i).text();
                    var resultPriceUnit = (pricelist * quantitylist) * 1000;
                    // resultpricetotal.push(resultPriceUnit);
                    resultPriceTotal.push(resultPriceUnit)
                    totalPrice += resultPriceTotal[i];
                }
                console.log(resultPriceTotal)
                var formatTotalPrice = new Intl.NumberFormat("id-ID", {
                    style: "currency",
                    currency: "IDR"
                }).format(totalPrice)
                document.getElementById('total_prices').value = totalPrice;
                document.getElementById('pricetotal').innerHTML = formatTotalPrice;
            });

            // console.log(parentList)
            var resultpricetotal = new Array()
            for (var i = 0; i < parentList; i++) {
                pricelist = $('#pricelist' + i).text();
                quantitylist = $('#quantitylist' + i).text();
                var resultpriceunit = (pricelist * quantitylist) * 1000;
                resultpricetotal.push(resultpriceunit);
                totalPrice += resultpricetotal[i];
            }
            console.log(totalPrice)
            var formatTotalPrice = new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR"
            }).format(totalPrice)
            document.getElementById('total_prices').value = totalPrice;
            document.getElementById('pricetotal').innerHTML = formatTotalPrice;

        });
    </script>
@endsection
