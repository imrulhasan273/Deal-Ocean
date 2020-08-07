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
                    <form class="header-search-form" action="{{route('products.search')}}" method="GET">
                        @csrf
                        <input name="query" type="text" placeholder="Search on Deal Ocean ....">
                        <button type="submit" name="submit"><i class="flaticon-search"></i></button>
                    </form>

                </div>
                <div class="col-xl-4 col-lg-5">
                    <div style="text-align: right" class="user-panel">
                        @php
                            $cartItems = DB::table('users')->where('id', auth()->id())->value('cartitems');
                            $res = preg_split('/\s+/', $cartItems);
                            $itemCount = count($res) - 1;
                        @endphp
                        <div class="up-item">
                            <div class="shopping-card">
                                <i class="flaticon-bag"></i>
                                <div></div>
                                <span class="itemCountAjax">{{ $itemCount ?? '' }}</span>
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
                        {{-- <li><a href="{{ route('product.products',1) }}">Category Page</a></li> --}}
                        <li><a href="{{ route('cart.index')}}">Cart Page</a></li>
                        <li><a href="{{route('contact')}}">Contact Page</a></li>
                    </ul>
                </li>
                @php
                    $categoriesH = App\Category::where('parent_id', 0)->get();
                @endphp

                @foreach ($categoriesH as $categoryH)
                <li><a href="{{ route('product.products',$categoryH->id) }}">{{$categoryH->name}}</a>
                    <ul class="sub-menu">
                        @php
                            $subCategoriesH = App\Category::where('parent_id',$categoryH->id)->get();
                        @endphp
                        @foreach ($subCategoriesH as $subCategoryH)
                        <li><a href="{{route('product.products',$subCategoryH->id)}}">{{$subCategoryH->name}}<span></span></a></li>
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

