@extends('profile.template')

@section('title')
    Purchase
@endsection

@section('activeOrder')
    active
@endsection

@section('body-profile')
    <div class="content-order">
        <div class="header-order">
            <ul>
                <li><a class="@yield('activeAll')" href="{{route('user.purchase')}}?type=all">All</a></li>
                <li><a class="@yield('activePay')" href="{{route('user.purchase')}}?type=to-pay">To Pay</a></li>
                <li><a class="@yield('activeShip')" href="#">To Ship</a></li>
                <li><a class="@yield('activeReceive')" href="#">To Receive</a></li>
                <li><a class="@yield('activeCompleted')" href="#">Completed</a></li>
            </ul>
        </div>
        <div class="body-profile">
            @if (request()->type == 'all' || request()->type == null)
                @include('profile.partials_orders.all-order')
            @elseif(request()->type == 'to-pay')
                
            @endif
        </div>
    </div>
@endsection
