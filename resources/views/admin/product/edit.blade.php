@extends('admin.template.header')

@section('title')
    Edit Product
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin/product.css') }}">
@endsection

@section('activeProduct')
    active
@endsection

@section('content')
    {{-- {{ dd($category) }} --}}
    <div class="content-create">
        <div class="main-content">
            <div class="action">
                <a href="{{ route('product.index') }}"><i class="fa-solid fa-circle-arrow-left"></i></a>
            </div>
            <div class="form">
                <form action="{{ route('product.update', $product->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-grp">
                        <label for="">Name Product</label>
                        <input value="{{ $product->name }}" type="text" name="name" id=""
                            placeholder="Enter Name Category">
                    </div>
                    <div class="form-grp small">
                        <div class="form-small">
                            <label for="">Sku Product</label>
                            <input value="{{ $product->sku }}" type="text" name="sku" maxlength="20" id=""
                                placeholder="Enter Sku Product">
                        </div>
                        <div class="form-small">
                            <label for="">Stock Product</label>
                            <input value="{{ $product->stock }}" type="number" name="stock" maxlength="10" id=""
                                placeholder="Pcs.">
                        </div>
                        <div class="form-small">
                            <label for="">Unit Product</label>
                            <input value="{{ $product->unit }}" type="text" name="unit" maxlength="20" id=""
                                placeholder="Enter No Unit Produck">
                        </div>
                        <div class="form-small">
                            <label for="">Weight Product</label>
                            <input value="{{ $product->weight }}" type="number" name="weight" maxlength="20"
                                id="" placeholder="kg.">
                        </div>
                        <div class="form-small">
                            <label for="">Price Product</label>
                            <input value="{{ $product->price }}" type="number" name="price" maxlength="20" id=""
                                placeholder="Rp.">
                        </div>
                        <div class="form-small">
                            <label for="">Category Product</label>
                            <select name="category_id" id="">
                                <option>-Select Category Product</option>
                                <optgroup label="Category">
                                    @foreach ($category as $cate)
                                        <option <?php
                                        if ($cate->id == $product->category_id) {
                                            echo 'selected';
                                        }
                                        ?> value="{{ $cate->id }}">{{ $cate->name }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                        <div style="visibility: hidden" class="form-small">
                            <label for="">Status Product</label>
                            <select name="as" id="">
                                <option>-Select Product Status</option>
                                <optgroup label="Status">
                                    <option value="0">Active</option>
                                    <option value="1">Non Active</option>
                                </optgroup>
                            </select>
                        </div>
                        <div class="form-small">
                            <label for="">Status Product</label>
                            <select name="is_active" id="">
                                <option>-Select Product Status-</option>
                                <optgroup label="Status">
                                    <option value="0" {{$product->is_active == '0' ? 'selected' : ''}}>Non Active</option>
                                    <option value="1" {{$product->is_active == '1' ? 'selected' : ''}}>Active</option>
                                </optgroup>
                            </select>
                        </div>
                        <div style="visibility: hidden" class="form-small">
                            <label for="">Status Product</label>
                            <select name="as" id="">
                                <option>-Select Product Status</option>
                                <optgroup label="Status">
                                    <option value="0">Active</option>
                                    <option value="1">Non Active</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="form-grp ">
                        <label for="">Description product</label>
                        <textarea name="description" id="description" cols="30" rows="10" placeholder="Enter Description">{{ $product->description }}</textarea>
                    </div>
                    <div class="form-butt">
                        <button>Update  Product</button>
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
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [{
                    value: 'First.Name',
                    title: 'First Name'
                },
                {
                    value: 'Email',
                    title: 'Email'
                },
            ]
        });
    </script>
@endsection
