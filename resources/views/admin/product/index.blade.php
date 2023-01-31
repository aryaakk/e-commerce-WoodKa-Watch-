@extends('admin.template.header')

@section('title')
    Product
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin/product.css') }}">
@endsection

@section('activeProduct')
    active
@endsection

@section('content')
    {{-- {{dd(session('status'))}} --}}
    <div class="content-index">
        <div class="header-content">
            <div class="action">
                <a href="{{ route('product.create') }}">Add Product</a>
            </div>
            <div class="search">
                <input type="text" id="search" placeholder="Search Product">
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
                    </button>`
                </div>
            @endif
            <div class="wrapper-table">
                <table cellspacing="0">
                    <thead>
                        <tr>
                            <th style="border-radius: 10px 0 0 0;" width="50">#</th>
                            <th width="300">Name</th>
                            <th width="100">SKU</th>
                            <th width="100">Stock</th>
                            <th width="100">Unit</th>
                            <th width="100">Weight</th>
                            <th width="200">Price</th>
                            <th width="200">Category</th>
                            <th width="100">Is Active</th>
                            <th style="border-radius: 0 10px 0 0;" width="200">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!count($product))
                            <tr>
                                <td colspan="10">No Product Added</td>
                            </tr>
                        @endif
                        @foreach ($product as $key => $prod)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $prod->name }}</td>
                                <td>{{ $prod->sku }}</td>
                                <td>{{ $prod->stock }}</td>
                                <td>{{ $prod->unit }}</td>
                                <td>{{ $prod->weight }}</td>
                                <td>{{ $prod->price }}</td>
                                <td>{{ $prod->category->name }}</td>
                                @if ($prod->is_active == 1)
                                    <td><span class="active"><i class="fa-solid fa-toggle-on"></i></span></td>
                                @else
                                    <td><span class="not-active"><i class="fa-solid fa-toggle-off"></i></span></td>
                                @endif
                                <td>
                                    <div class="option">
                                        <a href="{{ route('product.edit', $prod->id) }}"><i
                                                class="fi fi-sr-blog-pencil"></i></a>
                                        <form onsubmit="return confirm('Are You Sure to Want Delete??')"
                                            action="{{ route('product.destroy', $prod->id) }}" method="POST">
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
