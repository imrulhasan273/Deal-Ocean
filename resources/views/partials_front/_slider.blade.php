	<!-- Hero section -->
	<section class="hero-section">
		<div class="hero-slider owl-carousel">
            @foreach ($sliders as $slider)
            <div class="hs-item set-bg" data-setbg="{{asset('/storage/slider/'.$slider->slider_img)}}">
				<div class="container">
					<div class="row">
						<div class="col-xl-6 col-lg-7 text-white">
                            <span>{{ $slider->title }}</span>
                            <h2>{{ $slider->name }}</h2>
                            <p>{{ $slider->description }}</p>
							<a href="#" class="site-btn sb-line">DISCOVER</a>
							<a href="#" class="site-btn sb-white">ADD TO CART</a>
						</div>
					</div>
					<div class="offer-card text-white">
						<span>from</span>
                        <h2>${{$slider->price}}</h2>
						<a href="#">SHOP NOW</a>
					</div>
				</div>
			</div>
            @endforeach

		</div>
		<div class="container">
			<div class="slide-num-holder" id="snh-1"></div>
		</div>
	</section>
	<!-- Hero section end -->
