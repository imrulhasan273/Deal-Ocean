@extends('layouts.frontend')
@section('content')

    <!-- Start Slider -->
    @include('partials_front._slider')
    <!-- End Slider -->


      <!-- Features section -->
	<section class="features-section">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-4 p-0 feature">
					<div class="feature-inner">
						<div class="feature-icon">
							<img src="assets_front/img/icons/1.png" alt="#">
						</div>
						<h2>Fast Secure Payments</h2>
					</div>
				</div>
				<div class="col-md-4 p-0 feature">
					<div class="feature-inner">
						<div class="feature-icon">
							<img src="assets_front/img/icons/2.png" alt="#">
						</div>
						<h2>Premium Products</h2>
					</div>
				</div>
				<div class="col-md-4 p-0 feature">
					<div class="feature-inner">
						<div class="feature-icon">
							<img src="assets_front/img/icons/3.png" alt="#">
						</div>
						<h2>Free & fast Delivery</h2>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Features section end -->

    <!-- letest product section -->
    <section class="top-letest-product-section">
        <div class="container">
            <div class="section-title">
                <h2>LATEST PRODUCTS</h2>
            </div>
            <div class="product-slider owl-carousel">
                @foreach ($products as $product)
                <div class="product-item">
                    <div class="pi-pic">
                        <img src="{{asset('/storage/products/'.$product->cover_img)}}" alt="">
                        <div class="pi-links">
                            <a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
                            <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
                        </div>
                    </div>
                    <div class="pi-text">
                        <h6>${{ $product->price }}</h6>
                        <p>{{ $product->name }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- letest product section end -->

    <!-- Product filter section -->
	<section class="product-filter-section">
		<div class="container">

			<div class="section-title">
				<h2>BROWSE MORE PRODUCTS</h2>
			</div>
			<ul class="product-filter-menu">
                <li><a href="#">Top</a></li>
                <li><a href="#">Women</a></li>
				<li><a href="#">Men</a></li>
				<li><a href="#">Laptop</a></li>
				<li><a href="#">Fridge</a></li>
				<li><a href="#">LCD Monitor</a></li>
				<li><a href="#">Mobile</a></li>
				<li><a href="#">Accesories</a></li>
            </ul>

			<div class="row">
                @foreach ($products as $product)
                <div class="col-lg-3 col-sm-6">
					<div class="product-item">
						<div class="pi-pic">
							<img src="{{asset('/storage/products/'.$product->cover_img)}}" alt="">
							<div class="pi-links">
                                <a href="{{ route('cart.add', $product->id) }}" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
								<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
							</div>
						</div>
						<div class="pi-text">
                            <h6>${{ $product->price }}</h6>
							<p>{{ $product->name }} </p>
						</div>
					</div>
				</div>
                @endforeach


            </div>

			<div class="text-center pt-5">
				<button class="site-btn sb-line sb-dark">LOAD MORE</button>
			</div>
		</div>
	</section>
    <!-- Product filter section end -->

    @include('partials_front._banner')

@endsection
