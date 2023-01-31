@extends('users.template.header')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/user/profile.css') }}">
@endsection

@section('content')
    <div class="content-account">
        <div class="sidebar">
            <div class="header-side">
                <span>Profile Information</span>
            </div>
            <hr>
            <div class="body-side">
                <ul>
                    <li><a class="@yield('activeProfile')" href="{{route('profile.edit')}}"><i class="fa-solid fa-user"></i>Profile</a></li>
                    <li><a class="@yield('activeAddress')" href="{{route('user.address')}}"><i class="fa-solid fa-location-dot"></i>Address</a></li>
                    <li><a class="@yield('activeOrder')" href="{{route('user.purchase')}}"><i class="fa-solid fa-clipboard-list"></i>My Order</a></li>
                </ul>
            </div>
            <div class="footer-side">   
                <form  action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button onclick="return confirm('Are You Sure Want to Quitt??')" class="logout">Logout</button>
                </form>
            </div>
        </div>
        <div class="body-account">
            @yield('body-profile')
        </div>
    </div>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div> --}}
@endsection
