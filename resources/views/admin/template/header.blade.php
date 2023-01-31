<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"  />
    <!-- title -->
    <title>@yield('title') | WoodKa</title>
    {{-- favicon --}}
    <link rel="shortcut icon" href="{{ asset('imgAsset/woodka-png.png') }}">

    {{-- font icon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-solid-rounded/css/uicons-solid-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>

    <!-- font all -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Amaranth&family=Bubblegum+Sans&family=Concert+One&family=Itim&family=Josefin+Sans:wght@500&family=Lilita+One&family=Patrick+Hand&family=Poppins:wght@600&family=Roboto+Slab:wght@500&display=swap"
        rel="stylesheet">

    {{-- link bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">


    <!-- font Paragraph -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amarante&family=Andada+Pro&family=Sofia+Sans&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin/template.css') }}">

    {{-- link tiny cloud --}}
    <script src="https://cdn.tiny.cloud/1/4fosxpqdzfqfecgguoli60ua4kql5nq76h3d1pwmai9zdlhc/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>

    @yield('style')
</head>

<body>
    <section id="content">
        <div class="wrapper-side">
            <div class="sidebar">
                <div class="header-side">
                    <div class="img-header">
                        <img onclick="return window.location.href = '{{ route('admin.index') }}'"
                            src="{{ asset('imgAsset/woodka-png.png') }}" alt="">
                    </div>
                    <span>WoodKa</span>
                </div>
                <hr class="row-side">
                <div class="content-side">
                    <ul>
                        <li class="@yield('activeDash')"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                        <li class="@yield('activeOrder')"><a href="{{ route('admin.index') }}">OrderedList</a></li>
                        <li class="@yield('activeProduct')"><a href="{{ route('product.index') }}">Product</a></li>
                        <li class="@yield('activeProdImg')"><a href="{{ route('image.index') }}">ProductImages</a></li>
                        <li class="@yield('activeCateProd')"><a href="{{ route('category.index') }}">CategoryProduct</a></li>
                        <li class="@yield('activeReview ')"><a href="{{ route('admin.index') }}">AllReviewsProduct</a></li>
                        <li class="@yield('activeUsers')"><a href="">Users</a></li>
                    </ul>
                </div>
                {{-- <div class="footer-side">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button onclick="return confirm('Yakin Untuk Logout??')" class="logout">
                            {{ __('logout') }}<i class="fa-solid fa-right-from-bracket"></i>
                        </button>
                    </form>
                </div> --}}
            </div>
        </div>
        <div class="main">
            <div class="header">
                <div class="brand">
                    <div class="head">
                        <span>Pages / <b>@yield('title')</b></span>
                    </div>
                    <div class="ket">
                        <span>@yield('title')</span>
                    </div>
                </div>
                <div class="users">
                    <div class="dropdown">
                        <div class="drop" type="button" data-toggle="dropdown" aria-expanded="false">
                            <div class="img">
                                <img src="{{ asset('imgAvatar/guestAvatar.jpg') }}" alt="">
                            </div>
                            <div class="ket">
                                <div class="name">
                                    <span>{{ Auth::user()->name }}</span>
                                </div>
                                <div class="dropdown">
                                    <i class="fi fi-sr-caret-down"></i>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-menu dropdwn">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                            <div class="dropdown-divider"></div>
                            <form method="POST" onsubmit="return confirm('Yakin Untuk Logout??');"
                                action="{{ route('logout') }}">
                                @csrf
                                <button>
                                    logout<i class="fa-solid fa-right-from-bracket"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    {{-- <div class="img">
                        <img src="{{ asset('imgAvatar/guestAvatar.jpg') }}" alt="">
                    </div>
                    <div class="ket">
                        <div class="name">
                            <span>{{ Auth::user()->name }}</span>
                        </div>
                        <div class="dropdown">
                            <i class="fi fi-sr-caret-down"></i>
                        </div>
                    </div>
                    <div class="dropdown-menu dropdwn">
                        <a class="dropdown-item" href="{{ route('admin.index') }}">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" onsubmit="return confirm('Yakin Untuk Logout??');"
                            action="{{ route('logout') }}">
                            @csrf
                            <button>
                                logout<i class="fa-solid fa-right-from-bracket"></i>
                            </button>
                        </form>
                    </div> --}}
                </div>
            </div>
            @yield('content')
        </div>
    </section>

    {{-- script js --}}
    @yield('script')
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script> --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
</body>

</html>
