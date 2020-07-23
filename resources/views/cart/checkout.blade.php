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

	<!-- checkout section  -->
	<section class="checkout-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 order-2 order-lg-1">
                    <form method="post" action="{{route('orders.store')}}" class="checkout-form" >
                        @csrf
						<div class="cf-title">Billing Address</div>
						<div class="row address-inputs">
							<div class="col-md-12">
                                <input name="billing_state" type="text" placeholder="Country">
                                <input name="billing_fullname" type="text" placeholder="Full Name">
                                <input name="billing_address" type="text" placeholder="Address">
                                <input name="billing_city" type="text" placeholder="City">
							</div>
							<div class="col-md-6">
								<input name="billing_zipcode" type="text" placeholder="Zip code">
							</div>
							<div class="col-md-6">
								<input name="billing_phone" type="text" placeholder="Phone no.">
							</div>
                        </div>

                        <h3>
                            <label><p>Ship to a different address?</p></label>
                            <input name="shipping_check" id="ship-box" type="checkbox" />
                        </h3>

                        <div class="cf-title">Shipping Address</div>
						<div class="row address-inputs">
							<div class="col-md-12">
                                <input name="shipping_state" type="text" placeholder="Country">
                                <input name="shipping_fullname" type="text" placeholder="Full Name">
                                <input name="shipping_address" type="text" placeholder="Address">
                                <input name="shipping_city" type="text" placeholder="City">
							</div>
							<div class="col-md-6">
								<input name="shipping_zipcode" type="text" placeholder="Zip code">
							</div>
							<div class="col-md-6">
								<input name="shipping_phone" type="text" placeholder="Phone no.">
							</div>
                        </div>

                        <div class="col-md-12">
                            <div class="country-select">
                                <label>Payment Option<span class="required">*</span></label>
                                <select name="payment_method">
                                    <option value="cash_on_delivery">Cash On Delivary</option>
                                    <option value="online">Online</option>
                                </select>
                            </div>
                        </div>

                        <input type="submit" class="site-btn submit-order-btn" value="Place Order"/>

					</form>
				</div>
				<div class="col-lg-4 order-1 order-lg-2">
					<div class="checkout-cart">
						<h3>Your Cart</h3>
						<ul class="product-list">
							<li>
								<div class="pl-thumb"><img src="{{asset('assets_front/img/cart/1.jpg')}}" alt=""></div>
								<h6>Animal Print Dress</h6>
								<p>$45.90</p>
							</li>
							<li>
								<div class="pl-thumb"><img src="{{asset('assets_front/img/cart/2.jpg')}}" alt=""></div>
								<h6>Animal Print Dress</h6>
								<p>$45.90</p>
							</li>
						</ul>
						<ul class="price-list">
							<li>Total<span>$99.90</span></li>
							<li>Shipping<span>free</span></li>
							<li class="total">Total<span>$99.90</span></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- checkout section end -->
@endsection
