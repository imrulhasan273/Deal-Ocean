@extends('layouts.front')
@section('content')

<!-- checkout-area start -->
<div class="checkout-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="coupon-accordion">
                    <!-- ACCORDION START -->
                    <h3>Have a coupon? <span id="showcoupon">Click here to enter your code</span></h3>
                    <div id="checkout_coupon" class="coupon-checkout-content">
                        <div class="coupon-info">
                            <form action="#">
                                <p class="checkout-coupon">
                                    <input type="text" placeholder="Coupon code" />
                                    <input type="submit" value="Apply Coupon" />
                                </p>
                            </form>
                        </div>
                    </div>
                    <!-- ACCORDION END -->
                </div>
            </div>
        </div>

        <!-- Form Start -->
        <form action="{{route('orders.store')}}" method="post">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12">
                    @csrf
                    <div class="checkbox-form">
                        <h3>Billing Details</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="country-select">
                                    @error('billing_state')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <label>Country / State <span class="required">*</span></label>
                                    <select name="billing_state">
                                        <option value="Bangladesh">bangladesh</option>
                                        <option value="India">India</option>
                                        <option value="Afghanistan">Afghanistan</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="USA">U.S.A</option>
                                        <option value="Germany">Germany</option>
                                        <option value="Canada">Canada</option>
                                        <option value="Saudi Arabia">Saudi Arabia</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    @error('billing_fullname')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <label>Full Name <span class="required">*</span></label>
                                    <input name="billing_fullname" type="text" placeholder="" />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    @error('billing_address')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <label>Address <span class="required">*</span></label>
                                    <input name="billing_address" type="text" placeholder="Street address" />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    @error('billing_city')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <label>Town / City <span class="required">*</span></label>
                                    <input name="billing_city" type="text" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    @error('billing_zipcode')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <label>Postcode / Zip <span class="required">*</span></label>
                                    <input name="billing_zipcode" type="text" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    @error('billing_phone')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <label>Phone / Mobile  <span class="required">*</span></label>
                                    <input name="billing_phone" type="text" />
                                </div>
                            </div>
                        </div>

                        <!-- Shipping Details -->
                        <div class="different-address">
                            <div class="ship-different-title">
                                <h3>
                                    <label>Ship to a different address?</label>
                                    <input name="shipping_check" id="ship-box" type="checkbox" />
                                </h3>
                            </div>
                            <div id="ship-box-info" class="row">
                                <div class="col-md-12">
                                    <div class="country-select">
                                        @error('shipping_state')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <label>Country / State <span class="required">*</span></label>
                                        <select name="shipping_state">
                                            <option value="Bangladesh">bangladesh</option>
                                            <option value="India">India</option>
                                            <option value="Afghanistan">Afghanistan</option>
                                            <option value="Pakistan">Pakistan</option>
                                            <option value="USA">U.S.A</option>
                                            <option value="Germany">Germany</option>
                                            <option value="Canada">Canada</option>
                                            <option value="Saudi Arabia">Saudi Arabia</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        @error('shipping_fullname')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <label>Full Name <span class="required">*</span></label>
                                        <input name="shipping_fullname" type="text" placeholder="" />
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        @error('shipping_address')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <label>Address <span class="required">*</span></label>
                                        <input name="shipping_address" type="text" placeholder="Street address" />
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        @error('shipping_city')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <label>Town / City <span class="required">*</span></label>
                                        <input name="shipping_city" type="text" />
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        @error('shipping_zipcode')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <label>Postcode / Zip <span class="required">*</span></label>
                                        <input name="shipping_zipcode" type="text" />
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        @error('shipping_phone')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <label>Phone / Mobile  <span class="required">*</span></label>
                                        <input name="shipping_phone" type="text" />
                                    </div>
                                </div>

                            </div>

                            <div class="order-notes">
                                <div class="checkout-form-list mrg-nn">
                                    <label>Order Notes</label>
                                    <textarea name="order_note" id="checkout-mess" cols="30" rows="10" placeholder="Notes about your order, e.g. special notes for delivery." ></textarea>
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
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12 col-12">
                    <div class="your-order">
                        <h3>Your order</h3>
                        <div class="your-order-table table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="product-name">Product</th>
                                        <th class="product-total">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartItems as $item)
                                    <tr class="cart_item">
                                        <td class="product-name">
                                            {{ $item->name }} <strong class="product-quantity"> × {{ $item->quantity }}</strong>
                                        </td>
                                        <td class="product-total">
                                            <span class="amount">${{ Cart::session(auth()->id())->get($item->id)->getPriceSum()}}</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="cart-subtotal">
                                        <th>Cart Subtotal</th>
                                            <td><span class="amount">$000.00</span></td>
                                    </tr>
                                    <tr class="order-total">
                                        <th>Order Total</th>
                                        <td><strong><span class="amount">${{ Cart::session(auth()->id())->getTotal() }}</span></strong>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="order-button-payment">
                        <input type="submit" value="Place order" />
                    </div>
                </div>
            </div>
        </form>
        <!-- Form End -->

    </div>

</div>
<!-- checkout-area end -->

@endsection
