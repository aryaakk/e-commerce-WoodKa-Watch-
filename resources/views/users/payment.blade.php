@extends('users.template.header')

@section('title')
    Payment
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/user/payment.css') }}">
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
@endsection

@section('content')
    {{-- {{dd($order->created_at)}} --}}
    <div class="content-payment">
        <div class="payment-wrapper">
            <div class="header-payment">
                <a href="{{route('user.purchase')}}?type=all"><i class="fa-solid fa-arrow-left"></i></a>
                <span>Payment</span>
            </div>
            <hr>
            <div class="body-payment">
                <div class="header-body">
                    <span>Waiting For Payment</span>
                </div>
                <div class="total-payment">
                    <span>Total to be paid ({{ count($order->detail_order) }} Product) : </span>
                    <span class="price">Rp {{ number_format($order->total_price, 2, ',', '.') }}</span>
                </div>
                <div class="countdown-timer">
                    <span>Pay In</span>
                    <div class="timer">
                        <span id="timer"></span>
                        <span class="due-date">Due Date in {{$limit_date}}</span>
                    </div>
                </div>
                <div class="butt-payment">
                    <button id="pay-button">Pay Now!!</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay('{{ $order->token }}', {
                onSuccess: function(result) {
                    /* You may add your own implementation here */
                    alert("payment success!");
                    window.location.href = '{{ route('timepiece') }}'
                    console.log(result);
                },
                onPending: function(result) {
                    /* You may add your own i   mplementation here */
                    alert("wating your payment!");
                    console.log(result);
                },
                onError: function(result) {
                    /* You may add your own implementation here */
                    alert("payment failed!");
                    console.log(result);
                },
                onClose: function() {
                    /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                }
            })
        });

        var dateLimit = new Date("{{ $limit_date }}").getTime();
        console.log(dateLimit);

        var x = setInterval(function() {

            // var now = new Date(dateOrder).getTime();
            var dateOrder = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = dateLimit - dateOrder;
            console.log(distance)

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            document.getElementById("timer").innerHTML = hours + "h " +
                minutes + "m " + seconds + "s ";

            // If the count down is over, write some text 
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("timer").innerHTML = "EXPIRED";
            }
        }, 1000);
    </script>
@endsection
