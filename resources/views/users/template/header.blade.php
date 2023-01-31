<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"  />
    <!-- title -->
    <title>@yield('title') | WoodKa Watch</title>
    {{-- favicon --}}
    <link rel="shortcut icon" href="{{ asset('imgAsset/woodka-png.png') }}">

    {{-- font icon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-solid-rounded/css/uicons-solid-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- font all -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Amaranth&family=Bubblegum+Sans&family=Concert+One&family=Itim&family=Josefin+Sans:wght@500&family=Lilita+One&family=Patrick+Hand&family=Poppins:wght@600&family=Roboto+Slab:wght@500&display=swap"
        rel="stylesheet">

    {{-- link bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    {{-- link jquery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <!-- font Paragraph -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amarante&family=Andada+Pro&family=Sofia+Sans&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/user/template.css') }}">


    @yield('style')
</head>

<body>
    <section id="content">
        <div class="header">
            <nav>
                <div class="nav-brand">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('user.index') }}"><span>WoodKa</span></a>
                        @else
                            <a href="{{ route('guest.index') }}"><span>WoodKa</span></a>
                        @endauth
                    @endif
                </div>
                <div class="menu">
                    <ul>
                        <li><a href="{{ route('timepiece') }}">TimePiece</a></li>
                        <li><a href="{{ route('straps') }}">Straps</a></li>
                        <li><a href="">About Us</a></li>
                    </ul>
                </div>
                <div class="anoun">
                    <a class="search" href="{{route('product.index')}}"><i
                            class='bx bx-search-alt'></i></a>
                    @if (Route::has('login'))
                        @auth
                            <div class="account">
                                <i class="fa-solid fa-user-large"></i>
                                <div class="dropdown-user">
                                    <ul>
                                        <li><span>Hello {{ Auth::user()->name }}</span></li>
                                        <li><a href="{{ route('profile.edit') }}">My Account</a></li>
                                        <li>
                                            <hr>
                                        </li>
                                        <li>
                                            <form action="{{ route('logout') }}" method="POST">
                                                @csrf
                                                <button class="logout">Logout</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @else
                            <a class="account" href="{{ route('profile.edit') }}"><i class="fa-solid fa-user-large"></i></a>
                        @endauth
                    @endif
                    <a class="cart" href="{{ route('cart.index') }}"><i class="fi fi-sr-shopping-cart"></i></a>
                </div>
            </nav>
        </div>
        <div class="content">
            @yield('content')
        </div>
        </div>
    </section>

    {{-- modal search --}}
    {{-- <div class="modal fade" id="search" tabindex="-1" aria-labelledby="searchModal" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-search">
            <div class="modal-content modal-cont">
                <div class="modal-header modal-head">
                    <h5 class="modal-title" id="searchModal">Search Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body bdy-modal">
                    <form action="{{ route('product.index') }}" method="POST">
                        @csrf
                        <input type="text" name="search" id="" placeholder="Search Product..." required>
                        <button><i class='bx bx-search-alt'></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- script js --}}
    @yield('script')
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>

</html>
