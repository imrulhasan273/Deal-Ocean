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
                                <span>{{ $itemCount ?? '' }}</span>
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
            <ul style="width: 100%" class="main-menu">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="#">Pages</a>
                    <ul class="sub-menu">
                        <li><a href="{{ route('product.details') }}">Product Page</a></li>
                        {{-- <li><a href="{{ route('product.products') }}">Category Page</a></li> --}}
                        <li><a href="{{ route('cart.index')}}">Cart Page</a></li>
                        <li><a href="{{route('contact')}}">Contact Page</a></li>
                    </ul>
                </li>

                @foreach ($categories as $category)
                <li><a href="{{ route('product.products',$category->id) }}">{{$category->name}}</a>
                    <ul class="sub-menu">
                        @php
                            $subCategories = App\Category::where('parent_id',$category->id)->get();
                        @endphp
                        @foreach ($subCategories as $subCategory)
                        <li><a href="{{route('product.products',$subCategory->id)}}">{{$subCategory->name}}<span></span></a></li>
                        @endforeach
                    </ul>
                </li>
                @endforeach

                {{-- @foreach ($categories as $category)
                    <li><a href="{{ route('product.products',$category->id) }}">{{$category->name}}</a></li>
                @endforeach --}}
            </ul>
        </div>
    </nav>
</header>
<!-- Header section end -->
