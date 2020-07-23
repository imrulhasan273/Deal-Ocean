@php
$subTotalPrice = 0;
$totalPrice = 0;
@endphp
@extends('layouts.frontend')
@section('content')
	<!-- Page info -->
	<div class="page-top-info">
		<div class="container">
			<h4>Your cart</h4>
			<div class="site-pagination">
				<a href="">Home</a> /
				<a href="">Your cart</a>
			</div>
		</div>
	</div>
	<!-- Page info end -->

	<!-- cart section end -->
	<section class="cart-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="cart-table">
                        <h3>Your Cart</h3>
                        <br>
						<div class="cart-table-warp">
							<table>
							<thead>
								<tr>
                                    <th class="product-th"></th>
                                    <th class="product-th">Product</th>
									<th class="quy-th">Quantity</th>
									<th class="size-th">SizeSize</th>
									<th class="total-th">Price</th>
                                </tr>
							</thead>
							<tbody>
                                @foreach ($cartItems as $item)
								<tr>
                                    <td class="remove-col">
                                        <a href="{{ route('cart.destroy', $item->id) }}">
                                            <i class="fa fa-remove"></i>
                                        </a>
                                    </td>
									<td class="product-col">
										<img src="{{asset('/storage/products/'.$item->cover_img)}}" alt="">
										<div class="pc-title">
                                            <h4>{{ $item->name }}</h4>
                                            <p>${{ $item->price }}</p>
										</div>
									</td>
									<td class="quy-col">
										<div class="quantity">
                                            <form id="myform">
                                                <div class="pro-qty">
                                                    <a href="{{ route('cart.update', [$item->id , 'd']) }}" class="dec qtybtn">-</a>
                                                    <input type="text" value="{{ $itemOccurrence[$item->id] }}" readonly>
                                                    <a href="{{ route('cart.update', [$item->id , 'i']) }}" class="inc qtybtn">+</a>
                                                </div>
                                            </form>
                                        </div>
									</td>
									<td class="size-col"><h4>Size M</h4></td>
                                    <td class="total-col"><h4>${{$item->price * $itemOccurrence[$item->id]}}</h4></td>
                                    @php
                                        $subTotalPrice = ($subTotalPrice + $item->price * $itemOccurrence[$item->id]);
                                        $totalPrice = $totalPrice + $item->price * $itemOccurrence[$item->id];
                                    @endphp
                                </tr>
                                @endforeach
							</tbody>
						</table>
                        </div>
                        @php
                        // calculating discount on coupon

                            $discountPrice=( ($couponDiscount*$subTotalPrice)/100 );
                            $totalPrice = $subTotalPrice - $discountPrice;
                        @endphp
						<div class="total-cost">
                            <h6>Sub Total <span>${{$subTotalPrice}}</span></h6>
                            <br>
                            <h6>Total <span>${{$totalPrice}}</span></h6>
                        </div>
                    <h6 style="text-align: center">You are saving total ${{$discountPrice}}</h6>

					</div>
				</div>
				<div class="col-lg-4 card-right">
                    <form action="{{ route('cart.coupon') }}" class="promo-code-form">
						<input name="coupon_code" type="text" placeholder="Enter promo code">
						<button name="submit" type="submit">Submit</button>
					</form>
                    <a href="{{route('cart.checkout')}}" class="site-btn">Proceed to checkout</a>
					<a href="{{route('home')}}" class="site-btn sb-dark">Continue shopping</a>
				</div>
			</div>
		</div>
	</section>
	<!-- cart section end -->

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
                    <img src="{{asset('assets_front/img/product/1.jpg')}}" alt="">
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
        </div>
    </div>
</section>
<!-- RELATED PRODUCTS section end -->
@endsection
