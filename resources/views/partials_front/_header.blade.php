<!-- Header section -->
<header class="header-section">
    <div id="heads" class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 text-center text-lg-left">
                    <!-- logo -->
                    <a href="{{ route('home') }}" class="site-logo">
                        <img src="{{asset('assets_front/img/logo.png')}}" alt="">
                    </a>
                </div>
                <div class="col-xl-6 col-lg-5">
                    <form class="header-search-form">
                        <input type="text" placeholder="Search on divisima ....">
                        <button><i class="flaticon-search"></i></button>
                    </form>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div style="text-align: right" class="user-panel">

                        <div class="up-item">
                            <div class="shopping-card">
                                <i class="flaticon-bag"></i>
                                <span>0</span>
                            </div>
                            <a href="{{ route('cart.index')}}">Shopping Cart</a>
                        </div>

                        @guest
                        <div class="up-item">
                            <i class="flaticon-profile"></i>
                            <a href="{{ route('login') }}">Sign In</a> / <a href="{{ route('register') }}">Create</a>
                        </div>
                        @else
                        <div class="up-item">
                            <i class="flaticon-profile" href="#"></i>
                            <a style="color: green" href="#">{{ Auth::user()->name }}</a>
                            <a href=""> | </a>
                            <a style="color: red" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" href="{{route('logout')}}">Log Out</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>

    <nav class="main-navbar">
        <div class="container">
            <!-- menu -->
            <ul class="main-menu">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="#">Women</a></li>
                <li><a href="#">Men</a></li>
                <li><a href="#">Jewelry
                    <span class="new">New</span>
                </a></li>
                <li><a href="#">Shoes</a>
                    <ul class="sub-menu">
                        <li><a href="#">Sneakers</a></li>
                        <li><a href="#">Sandals</a></li>
                        <li><a href="#">Formal Shoes</a></li>
                        <li><a href="#">Boots</a></li>
                        <li><a href="#">Flip Flops</a></li>
                    </ul>
                </li>
                <li><a href="#">Pages</a>
                    <ul class="sub-menu">
                        <li><a href="{{ route('product.details') }}">Product Page</a></li>
                        <li><a href="{{ route('product.products') }}">Category Page</a></li>
                        <li><a href="{{ route('cart.index')}}">Cart Page</a></li>
                        <li><a href="{{ route('cart.checkout')}}">Checkout Page</a></li>
                        <li><a href="{{route('contact')}}">Contact Page</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('product.products') }}">Category</a></li>
            </ul>
        </div>
    </nav>
</header>
<!-- Header section end -->
