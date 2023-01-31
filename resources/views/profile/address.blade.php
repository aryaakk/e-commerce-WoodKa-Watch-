@extends('profile.template')

@section('title')
    Profile
@endsection

@section('activeAddress')
    active
@endsection

@section('body-profile')
    {{-- {{dd($user)}} --}}
    <div class="content-address">
        <div class="header-address">
            <span>My Address</span>
        </div>
        <div class="body-address">
            <div class="header-body">
                <span>Alamat</span>
            </div>
            <div class="content-body">
                <div class="address__">
                    <div class="name-phone">
                        <span>{{ $user->name }}</span>
                        <div></div>
                        <span>{{ $user->phone }}</span>
                    </div>
                    <div class="address-cont">
                        <span>{{ $user->alamat }}</span>
                    </div>
                </div>
                <div class="action">
                    <a href="#" role="button" data-toggle="modal" data-target="#modalUbahAlamat">UBAH</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalUbahAlamat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-address" action="{{ route('user.address') }}" method="POST">
                        @csrf
                        @method('patch')
                        <div class="form-grp">
                            <label for="">Address</label>
                            <div class="form-inp">
                                <textarea name="alamat" id="" cols="30" rows="10">{{ $user->alamat }}</textarea>
                            </div>
                        </div>
                        <div class="form-butt">
                            <button class="close-address" type="button" data-dismiss="modal">Close</button>
                            <button class="save" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
