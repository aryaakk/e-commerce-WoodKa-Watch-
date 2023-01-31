@extends('admin.template.header')

@section('title')
    Add Category Product
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin/category.css') }}">
    <script src="https://cdn.tiny.cloud/1/4fosxpqdzfqfecgguoli60ua4kql5nq76h3d1pwmai9zdlhc/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
@endsection

@section('activeCateProd')
    active
@endsection

@section('content')
    {{-- {{dd(session('status'))}} --}}
    <div class="content-create">
        <div class="main-content">
            <div class="action">
                <a href="{{ route('category.index') }}"><i class="fa-solid fa-circle-arrow-left"></i></a>
            </div>
            <div class="form">
                <form action="{{ route('category.store') }}" method="POST">
                    @csrf

                    <div class="form-grp">
                        <label for="">Name Category</label>
                        <input type="text" name="name" id="" placeholder="Enter Name Category">
                    </div>
                    <div class="form-grp">
                        <label for="">Description Category</label>
                        <textarea name="description" id="description" cols="30" rows="10" placeholder="Enter Description"></textarea>
                    </div>
                    <div class="form-butt">
                        <button>Add Category</button>
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
