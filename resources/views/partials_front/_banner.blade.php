	<!-- Banner section -->
	<section class="banner-section">
		<div class="container">
            @foreach ($banners as $banner)
			<div class="banner set-bg" data-setbg="{{asset('/storage/banner/'.$banner->banner_img)}}">
                <div class="tag-new">{{$banner->title}}</div>
                <span>{{$banner->location}}</span>
                <h2>{{$banner->discount}}</h2>
                <h2>{{$banner->about}}</h2>
				<a href="#" class="site-btn">Open Your Shop</a>
            </div>
            @endforeach

		</div>
	</section>
	<!-- Banner section end  -->
