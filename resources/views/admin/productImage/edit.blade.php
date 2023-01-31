@extends('admin.template.header')

@section('title')
    Edit Product Image
@endsection

@section('style')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <link rel="stylesheet" href="{{ asset('css/admin/product-image.css') }}">
@endsection

@section('activeProdImg')
    active
@endsection

@section('content')
    {{-- {{dd(session('status'))}} --}}
    <div class="content-create">
        <div class="main-content">
            <div class="action">
                <a href="{{ route('image.index') }}"><i class="fa-solid fa-circle-arrow-left"></i></a>
            </div>
            <div class="form">
                <form id="formImage" action="{{ route('image.update', $image->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="form-grp">
                        <label for="">Select Product</label>
                        <select name="product_id">
                            <option value="">Select Product</option>
                            <optgroup label="Product">
                                @foreach ($product as $prod)
                                    <option value="{{ $prod->id }}" <?php
                                    if ($prod->id == $image->product_id) {
                                        echo 'selected';
                                    }
                                    ?>>{{ $prod->name }}</option>
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                    <div class="form-grp image">
                        <div id="formImage">
                            <label>Select Image</label>
                            <div class="img">
                                <img src="{{ asset('imageProduct/' . $image->image) }}" alt="">
                                <small>Abaikan Jika Tidak Ingin Dirubah!!</small>
                            </div>
                            <div class="file-input">
                                <div class="inputtan">
                                    <input type="file" name="image" accept="image/*">
                                    <select name="is_primary" id="" class="mt-3">
                                        <option>Select Primary Image</option>
                                        <optgroup label="Primary Image">
                                            <option value="0" {{ $image->is_primary == '0' ? 'selected' : '' }}>Not
                                                Primary</option>
                                            <option value="1" {{ $image->is_primary == '1' ? 'selected' : '' }}>Primary
                                            </option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-butt">
                        <button type="submit">Add Image Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
