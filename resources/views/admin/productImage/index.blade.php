@extends('admin.template.header')

@section('title')
    Product Image
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin/product-image.css') }}">
@endsection

@section('activeProdImg')
    active
@endsection

@section('content')
    {{-- {{dd($image)}} --}}
    <div class="content-index">
        <div class="header-content">
            <div class="action">
                <a href="{{ route('image.create') }}">Add Image</a>
            </div>
            <div class="search">
                <input type="text" id="search" placeholder="Search Category">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
        </div>
        <div class="main-content">
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
                <table cellspacing="0">
                    <thead>
                        <tr>
                            <th style="border-radius: 10px 0 0 0;" width="50">#</th>
                            <th width="300">Name Product</th>
                            <th width="300">Image Product</th>
                            <th width="200">Primary Image</th>
                            <th style="border-radius: 0 10px 0 0;" width="200">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($image as $key => $img)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><span class="product-name">{{ $img->name }}</< /td>
                                <td class="image">
                                    <div class="image-preview">
                                        <img src="{{ asset('imageProduct/' . $img->image) }}" alt="">
                                    </div>
                                </td>
                                @if ($img->is_primary == 1)
                                    <td><span class="primary">Primary</span></td>
                                @endif
                                <td>
                                    <div class="option">
                                        <a class="show-primary" href="{{route('image.show', $img->id_product)}}"><i class="fa-solid fa-images"></i>Show Images</a>
                                        {{-- <a href="{{ route('image.edit', $img->id) }}"><i
                                                class="fi fi-sr-blog-pencil"></i></a>
                                        <form onsubmit="return confirm('Are You Sure to Want Delete??')"
                                            action="{{ route('image.destroy', $img->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="delete"><i class="fi fi-sr-trash"></i></button>
                                        </form> --}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
