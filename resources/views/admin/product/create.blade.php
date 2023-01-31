@extends('admin.template.header')

@section('title')
    Add Product
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin/product.css') }}">
    <script src="https://cdn.tiny.cloud/1/4fosxpqdzfqfecgguoli60ua4kql5nq76h3d1pwmai9zdlhc/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
@endsection

@section('activeProduct')
    active
@endsection

@section('content')
    {{-- {{dd(session('status'))}} --}}
    <div class="content-create">
        <div class="main-content">
            <div class="action">
                <a href="{{ route('product.index') }}"><i class="fa-solid fa-circle-arrow-left"></i></a>
            </div>
            <div class="form">
                <form action="{{ route('product.store') }}" method="POST">
                    @csrf
                    <div class="form-grp">
                        <label for="">Name Product</label>
                        <input type="text" name="name" id="" placeholder="Enter Name Product">
                    </div>
                    <div class="form-grp small">
                        <div class="form-small">
                            <label for="">Sku Product</label>
                            <input type="text" name="sku" maxlength="20" id=""
                                placeholder="Enter Sku Product">
                        </div>
                        <div class="form-small">
                            <label for="">Stock Product</label>
                            <input type="number" name="stock" maxlength="10" id="" placeholder="Pcs.">
                        </div>
                        <div class="form-small">
                            <label for="">Unit Product</label>
                            <input type="text" name="unit" maxlength="20" id=""
                                placeholder="Enter No Unit Produck">
                        </div>
                        <div class="form-small">
                            <label for="">Weight Product</label>
                            <input type="number" name="weight" maxlength="20" id="" placeholder="kg/gr/mg">
                        </div>
                        <div class="form-small">
                            <label for="">Price Product</label>
                            <input type="number" name="price" maxlength="20" id="" placeholder="Rp.">
                        </div>
                        <div class="form-small">
                            <label for="">Category Product</label>
                            <select name="category_id" id="">
                                <option>-Select Category Product</option>
                                <optgroup label="Category">
                                    @foreach ($category as $cate)
                                        <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="form-grp ">
                        <label for="">Description product</label>
                        <textarea name="description" id="description" cols="30" rows="10" placeholder="Enter Description"></textarea>
                    </div>
                    <div class="form-butt">
                        <button>Add Product</button>
                    </div>
                </form>
            </div>
        </div>
        {{-- <div class="main-content">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span>{{ session('success') }}</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @elseif(session('failed'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <span>{{ session('failed') }}</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="wrapper-table">
            </div>
        </div> --}}
    </div>
@endsection

@section('script')
    <script>
        tinymce.init({
            selector: '#description',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });
    </script>
@endsection
