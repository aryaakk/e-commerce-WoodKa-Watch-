@extends('admin.template.header')

@section('title')
    Add Product Image
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
                <form id="formImage" action="{{ route('image.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <div class="form-grp">
                        <label for="">Select Product</label>
                        <select name="product_id">
                            <option value="">Select Product</option>
                            <optgroup label="Product">
                                @foreach ($product as $prod)
                                    <option value="{{ $prod->id }}">{{ $prod->name }}</option>
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                    <div class="form-grp">
                        <label for="">Select How Many Image</label>
                        <select id="manyImage" onchange="ManyImage(this.val)">
                            <option selected>How Many?? max:5</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option=>
                            <option>4</option=>
                            <option>5</option=>
                        </select>
                    </div>
                    <div id="renderFormImage" class="form-grp image">
                        {{-- <div id="formImage">
                            <label>Select Image</label>
                            <div class="file-input">
                                <div class="inputtan">
                                    <input type="file" name="image[]" accept=".jpg">
                                    <select name="is_primary" id="" class="mt-3">
                                        <option>Select Primary Image</option>
                                        <optgroup label="Primary Image">
                                            <option value="0">Non Primary</option>
                                            <option value="1">Primary</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <button type="button" id="remove"><i class="fa-solid fa-xmark"></i> Remove</button>
                            </div>
                        </div> --}}
                    </div>
                    <div class="form-butt">
                        <button type="button" onclick="checkSize()">Add Image Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function ManyImage() {
            const many = document.querySelector('#manyImage').value
            const form = document.querySelector('#renderFormImage')
            var formImage = ''
            // console.log(many.length)
            for (var i = 0; i < many; i++) {
                formImage += `<div id="inpImage">
                            <label>Select Image</label>
                            <div class="file-input">
                                <div class="inputtan">
                                    <input id="imageAdd[${i}]" type="file" name="image[]" accept="image/*">
                                    <select name="is_primary[]" id="primary[${i}]" class="mt-3">
                                        <option value="">Select Primary Image</option>
                                        <optgroup label="Primary Image">
                                            <option value="0">Non Primary</option>
                                            <option value="1">Primary</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <button type="button" id="remove"><i class="fa-solid fa-xmark"></i> Remove</button>
                            </div>
                        </div>`
            }
            form.innerHTML = formImage
        }

        function checkSize() {
            const many = document.querySelector('#manyImage').value
            // console.log(count(fileInput))
            for (var i = 0; i < many; i++) {
                var fileInput = document.getElementById('imageAdd[' + i + ']').files;
                // console.log(fileInput[0].size);
                var fsize = fileInput[0].size;
                var file = Math.round((fsize / 1024));
                console.log(file)
                if (file >= 10240) { //10MB
                    alert('You have exceeded maximum allowed size 10MB')
                    return
                }
            }
            document.querySelector('#formImage').submit();
        }

        $(document).ready(function() {
            $("body").on("click", "#remove", function() {
                $(this).parents("#inpImage").remove();
                const many = document.querySelector('#manyImage').value
                document.querySelector('#manyImage').value = Number(many) - 1
                if (many == 1) {
                    document.querySelector('#manyImage').value = 'How Many?? max:5'
                }
            });
        })
    </script>
@endsection
