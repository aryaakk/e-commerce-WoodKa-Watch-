@extends('admin.template.header')

@section('title')
    Category Product
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin/category.css') }}">
@endsection

@section('activeCateProd')
    active
@endsection

@section('content')
    {{-- {{dd(session('status'))}} --}}
    <div class="content-index">
        <div class="header-content">
            <div class="action">
                <a href="{{ route('category.create') }}">Add Category</a>
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
                            <th width="200">Name</th>
                            <th width="500">Description</th>
                            <th style="border-radius: 0 10px 0 0;" width="200">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category as $key => $cate)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $cate->name }}</td>
                                <td>{!! $cate->description !!}</td>
                                <td>
                                    <div class="option">
                                        <a href="{{ route('category.edit', $cate->id) }}"><i
                                                class="fi fi-sr-blog-pencil"></i></a>
                                        <form onsubmit="return confirm('Are You Sure to Want Delete??')"
                                            action="{{ route('category.destroy', $cate->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="delete"><i class="fi fi-sr-trash"></i></button>
                                        </form>
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
