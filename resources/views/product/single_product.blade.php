@extends('layouts.frontend')
@section('content')
<!-- Page info -->
<div class="page-top-info">
    <div class="container">
        <h4>Category PAge</h4>
        <div class="site-pagination">
            <a href="">Home</a> /
            <a href="">Shop</a>
        </div>
    </div>
</div>
<!-- Page info end -->

<!-- product section -->
<section class="product-section">
    <div class="container">
        <div class="back-link">
            <a href="./category.html"> &lt;&lt; Back to Category</a>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="product-pic-zoom">
                    <img class="product-big-img" src="{{asset('/storage/products/'.$product->cover_img)}}" alt="">
                </div>
                <div class="product-thumbs" tabindex="1" style="overflow: hidden; outline: none;">
                    <div class="product-thumbs-track">
                        <div class="pt active" data-imgbigurl="{{asset('/storage/products/'.$product->cover_img)}}"><img src="{{asset('/storage/products/'.$product->cover_img)}}" alt=""></div>
                        <div class="pt" data-imgbigurl="{{asset('assets_front/img/single-product/2.jpg')}}"><img src="{{asset('assets_front/img/single-product/thumb-2.jpg')}}" alt=""></div>
                        <div class="pt" data-imgbigurl="{{asset('assets_front/img/single-product/3.jpg')}}"><img src="{{asset('assets_front/img/single-product/thumb-3.jpg')}}" alt=""></div>
                        <div class="pt" data-imgbigurl="{{asset('assets_front/img/single-product/4.jpg')}}"><img src="{{asset('assets_front/img/single-product/thumb-4.jpg')}}" alt=""></div>
                    </div>
                </div>

                <div style="padding-bottom: 30px;">

                </div>

                <div id="accordion" class="accordion-area">
                <div class="panel">
                    <div class="panel-header" id="headingOne">
                        <button class="panel-link active" data-toggle="collapse" data-target="#collapseComment" aria-expanded="true" aria-controls="collapse1">Reviews</button>
                    </div>
                    <div id="collapseComment" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <!-- Comment Row -->
                        @foreach ($reviews as $review)
                        <div style="padding-bottom: 20px;" class="d-flex flex-row comment-row m-t-0">
                            <div class="p-2"><img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1574583336/AAA/4.jpg" alt="user" width="50" class="rounded-circle"></div>
                            <div class="comment-text w-100">
                                <h6 class="font-medium">{{ $review->user->name }}</h6> <span class="m-b-15 d-block">{{$review->comment}} </span>
                                <div class="comment-footer"> <span class="text-muted float-right">{{$review->created_at}}</span> <button type="button" class="btn btn-cyan btn-sm">Edit</button> <button type="button" class="btn btn-danger btn-sm">Delete</button> </div>
                            </div>
                        </div>
                        @endforeach
                        <!-- Comment Row -->

                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-6 product-details">
                <h2 class="p-title">{{ $product->name }}</h2>
                <h3 class="p-price">${{$product->price}}</h3>
                <h4 class="p-stock">Available: <span>In Stock</span></h4>
                <h4 class="p-stock">User Rated: <span class="COUNTajax">{{ $count }} users</span></h4>
                <h5 class="p-stock">Average Rating: <span class="RATINGajax">{{ $avg_rating }}</span></h5>


                <h4 class="p-stock">Your Rating: <span class="userRATINGajax">{{ $rating }}</span></h4>
                @php
                    $flag = $rating;
                @endphp
                <div id="HEZO" class="p-rating">
                    @for ($i = 1 ; $i <= 5 ; $i++)
                        @php
                            if($flag>0){$tail='';} else{$tail='fa-fade';}
                        @endphp
                        <a id = "AJAXStar" data-value="{{$product->id}} {{$i}}" class="btn"><i class="fa fa-star-o {{ $tail }}"></i></a>
                        @php
                            $flag--;
                        @endphp
                    @endfor
                </div>

                <div class="p-review">
                    <a href=""> votes</a>|
                </div>
                <div class="fw-size-choose">
                    <p>Size</p>
                    <div class="sc-item">
                        <input type="radio" name="sc" id="xs-size">
                        <label for="xs-size">32</label>
                    </div>
                    <div class="sc-item">
                        <input type="radio" name="sc" id="s-size">
                        <label for="s-size">34</label>
                    </div>
                    <div class="sc-item">
                        <input type="radio" name="sc" id="m-size" checked="">
                        <label for="m-size">36</label>
                    </div>
                    <div class="sc-item">
                        <input type="radio" name="sc" id="l-size">
                        <label for="l-size">38</label>
                    </div>
                    <div class="sc-item disable">
                        <input type="radio" name="sc" id="xl-size" disabled>
                        <label for="xl-size">40</label>
                    </div>
                    <div class="sc-item">
                        <input type="radio" name="sc" id="xxl-size">
                        <label for="xxl-size">42</label>
                    </div>
                </div>
                <div class="quantity">
                    <p>Quantity</p>
                    <div class="pro-qty"><input type="text" value="1"></div>
                </div>
                {{--  --}}
                <a href="{{ route('cart.add', $product->id) }}" class="site-btn">Add to Cart</a>

                <div id="accordion" class="accordion-area">
                    <div class="panel">
                        <div class="panel-header" id="headingOne">
                            <button class="panel-link active" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">information</button>
                        </div>
                        <div id="collapse1" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="panel-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pharetra tempor so dales. Phasellus sagittis auctor gravida. Integer bibendum sodales arcu id te mpus. Ut consectetur lacus leo, non scelerisque nulla euismod nec.</p>
                                <p>Approx length 66cm/26" (Based on a UK size 8 sample)</p>
                                <p>Mixed fibres</p>
                                <p>The Model wears a UK size 8/ EU size 36/ US size 4 and her height is 5'8"</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="panel-header" id="headingTwo">
                            <button class="panel-link" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">care details </button>
                        </div>
                        <div id="collapse2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="panel-body">
                                <img src="{{asset('assets_front/img/cards.png')}}" alt="">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pharetra tempor so dales. Phasellus sagittis auctor gravida. Integer bibendum sodales arcu id te mpus. Ut consectetur lacus leo, non scelerisque nulla euismod nec.</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="panel-header" id="headingThree">
                            <button class="panel-link" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">shipping & Returns</button>
                        </div>
                        <div id="collapse3" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                            <div class="panel-body">
                                <h4>7 Days Returns</h4>
                                <p>Cash on Delivery Available<br>Home Delivery <span>3 - 4 days</span></p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pharetra tempor so dales. Phasellus sagittis auctor gravida. Integer bibendum sodales arcu id te mpus. Ut consectetur lacus leo, non scelerisque nulla euismod nec.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="social-sharing">
                    <a href=""><i class="fa fa-google-plus"></i></a>
                    <a href=""><i class="fa fa-pinterest"></i></a>
                    <a href=""><i class="fa fa-facebook"></i></a>
                    <a href=""><i class="fa fa-twitter"></i></a>
                    <a href=""><i class="fa fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- product section end -->



<!-- RELATED PRODUCTS section -->
<section class="related-product-section">
    <div class="container">
        <div class="section-title">
            <h2>RELATED PRODUCTS</h2>
        </div>
        <div class="product-slider owl-carousel">
            <div class="product-item">
                <div class="pi-pic">
                    <img src="{{asset('assets_front/img/product/1.jpg')}}" alt="">
                    <div class="pi-links">
                        <a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
                        <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
                    </div>
                </div>
                <div class="pi-text">
                    <h6>$35,00</h6>
                    <p>Flamboyant Pink Top </p>
                </div>
            </div>
            <div class="product-item">
                <div class="pi-pic">
                    <div class="tag-new">New</div>
                    <img src="{{asset('assets_front/img/product/2.jpg')}}" alt="">
                    <div class="pi-links">
                        <a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
                        <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
                    </div>
                </div>
                <div class="pi-text">
                    <h6>$35,00</h6>
                    <p>Black and White Stripes Dress</p>
                </div>
            </div>
            <div class="product-item">
                <div class="pi-pic">
                    <img src="{{asset('assets_front/img/product/3.jpg')}}" alt="">
                    <div class="pi-links">
                        <a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
                        <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
                    </div>
                </div>
                <div class="pi-text">
                    <h6>$35,00</h6>
                    <p>Flamboyant Pink Top </p>
                </div>
            </div>
            <div class="product-item">
                    <div class="pi-pic">
                        <img src="{{asset('assets_front/img/product/4.jpg')}}" alt="">
                        <div class="pi-links">
                            <a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
                            <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
                        </div>
                    </div>
                    <div class="pi-text">
                        <h6>$35,00</h6>
                        <p>Flamboyant Pink Top </p>
                    </div>
                </div>
            <div class="product-item">
                <div class="pi-pic">
                    <img src="{{asset('assets_front/img/product/6.jpg')}}" alt="">
                    <div class="pi-links">
                        <a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
                        <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
                    </div>
                </div>
                <div class="pi-text">
                    <h6>$35,00</h6>
                    <p>Flamboyant Pink Top </p>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- RELATED PRODUCTS section end -->
@endsection
