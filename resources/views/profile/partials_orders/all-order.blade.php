<section>
    <div class="content-all-order">
        <div class="header-content-all">
            <span>All Order</span>
        </div>
        @foreach ($order as $key => $o)
            {{-- {{ dd($o->detail_order) }} --}}
            <div class="list-order">
                <div class="header-list">
                    <span># Ordered</span>
                    @if ($o->processed == 0)
                        <span class="kett">TO PAY</span>
                    @elseif($o->delivery_status == 'dikemas')
                        <span class="kett">TO SHIP</span>
                    @elseif($o->delivery_status == 'dikirim')
                        <span class="kett">TO RECEIVE</span>
                    @elseif($o->delivery_status == 'selesai')
                        <span class="kett">COMPLETED</span>
                    @endif
                </div>
                @foreach ($o->detail_order as $detail)
                    <div class="content-list">
                        <div class="left">
                            <div class="image">
                                <img style="width: 5rem" src="{{ asset('imageProduct/' . $detail->image) }}"
                                    alt="">
                            </div>
                            <div class="product-name">
                                <span>{{ $detail->name_product }}</span>
                            </div>
                        </div>
                        <div class="right">
                            <div class="price">
                                <span>Rp {{ number_format($detail->price, 2, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="footer-list">
                    <div class="price-total">
                        <small>Order Total</small>
                        <span>Rp {{ number_format($o->total_price, 2, ',', '.') }}</span>
                    </div>
                    <div class="butt-pay">
                        @if ($o->processed == 0)
                            <a href="{{ route('order.show', $o->id) }}">Pay Now!</a>
                        @elseif($o->delivery_status == 'dikirim')
                            <a href="{{ route('order.show', $o->id) }}">Order Received!</a>
                        @elseif($o->delivery_status == 'selesai')
                            <a href="{{ route('order.show', $o->id) }}">!</a>
                        @endif
                    </div>
                </div>
            </div>
            <hr>
        @endforeach
    </div>
</section>
