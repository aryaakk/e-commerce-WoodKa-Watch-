@extends('profile.template')

@section('title')
    Profile
@endsection

@section('activeProfile')
    active
@endsection

@section('body-profile')
    <div class="content-profile">
        <div class="header-profile">
            <span>My Profile</span>
        </div>
        <div class="body-profile">
            <div class="mp">
                @include('profile.partials.update-profile-information-form')
            </div>
            <div class="pass">
                @include('profile.partials.update-password-form')
            </div>
            <div class="acc-del">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
@endsection
