@extends('admin.template.header')

@section('title')
    Edit Category Product
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
                <form action="{{ route('category.update', $category->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-grp">
                        <label for="">Name Category</label>
                        <input type="text" name="name" id="" value="{{$category->name}}" placeholder="Enter Name Category">
                    </div>
                    <div class="form-grp">
                        <label for="">Description Category</label>
                        <textarea name="description" id="description" cols="30" rows="10" placeholder="Enter Description">{{$category->description}}</textarea>
                    </div>
                    <div class="form-butt">
                        <button>Update Category</button>
                    </div>
                </form>
            </div>
        </div>
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
