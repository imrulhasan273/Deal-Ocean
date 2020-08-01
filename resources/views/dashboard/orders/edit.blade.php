@php
$active='shops';
@endphp
@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Edit Order</h4>
          <p class="card-category">Complete</p>
        </div>
        <div class="card-body">
        <form method="POST" action="{{route('orders.update')}}">
        @csrf

            <hr>
            <label style="color:rgb(58, 134, 221)" class="bmd-label-floating">Order Information</label>
            <hr>

            <div class="row">
                <div class="col-md-5" hidden>
                    <div class="form-group">
                      <label class="bmd-label-floating">Order id</label>
                      <input name="order_id" value="{{ $order->id }}" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="bmd-label-floating">Order Number</label>
                        <input name="order_number" value="{{ $order->order_number }}" type="text" class="form-control" disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="bmd-label-floating">User ID</label>
                        <input name="user_id" value="{{ $order->user_id }}" type="text" class="form-control" disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="bmd-label-floating">Store ID</label>
                        <input name="store_id" value="{{ $order->store_id }}" type="text" class="form-control" disabled>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="bmd-label-floating">Sub Total</label>
                        <input name="sub_total" value="{{ $order->sub_total }}" type="text" class="form-control" disabled>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="bmd-label-floating">Discount</label>
                        <input name="discount" value="{{ $order->discount }}" type="text" class="form-control" disabled>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="bmd-label-floating">Grand Total</label>
                        <input name="grand_total" value="{{ $order->grand_total }}" type="text" class="form-control" disabled>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="bmd-label-floating">Item Count</label>
                        <input name="item_count" value="{{ $order->item_count }}" type="text" class="form-control" disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="bmd-label-floating">Transection ID</label>
                        <input name="tran_id" value="{{ $order->transection_id }}" type="text" class="form-control" disabled>
                    </div>
                </div>


                <div class="col-md-12">
                    <div class="form-group">
                        <label class="bmd-label-floating">Notes</label>
                        <input name="notes" value="{{ $order->notes }}" type="text" class="form-control" disabled>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="bmd-label-floating">Is Paid</label>
                        <select  name="is_paid" class="form-control">
                            <option style="color: rgb(20, 211, 77)" value="1" {{ $order->is_paid == '1' ? 'selected':'' }}>Paid</option>
                            <option style="color: rgb(231, 9, 9)" value="0" {{ $order->is_paid == '0' ? 'selected':'' }}>Un-Paid</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="bmd-label-floating">Status</label>
                        <select  name="status" class="form-control">
                            <option style="color: rgb(255, 14, 14)" value="failed" {{ $order->status == 'failed' ? 'selected':'' }}>Failed</option>
                            <option style="color: rgb(231, 9, 139)" value="canceled" {{ $order->status == 'canceled' ? 'selected':'' }}>Canceled</option>
                            <option style="color: rgb(9, 187, 231)" value="pending" {{ $order->status == 'pending' ? 'selected':'' }}>Pending</option>
                            <option style="color: rgb(134, 189, 89)" value="processing" {{ $order->status == 'processing' ? 'selected':'' }}>Processing</option>
                            <option style="color: rgb(5, 255, 80)" value="completed" {{ $order->status == 'completed' ? 'selected':'' }}>Completed</option>
                            <option style="color: rgb(231, 9, 9)" value="decline" {{ $order->status == 'decline' ? 'selected':'' }}>Decline</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="bmd-label-floating">Payment Method</label>
                        <input name="payment_method" value="{{ $order->payment_method }}" type="text" class="form-control" disabled>
                    </div>
                </div>
            </div>

            <hr>
            <label style="color:rgb(58, 134, 221)" class="bmd-label-floating">Shipping Information</label>
            <hr>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="bmd-label-floating">Full Name</label>
                        <input name="shipping_fullname" value="{{ $order->shipping_fullname }}" type="text" class="form-control" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="bmd-label-floating">Address</label>
                        <input name="shipping_address" value="{{ $order->shipping_address }}" type="text" class="form-control" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="bmd-label-floating">City</label>
                        <input name="shipping_city" value="{{ $order->shipping_city }}" type="text" class="form-control" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="bmd-label-floating">State/Country</label>
                        <input name="shipping_state" value="{{ $order->shipping_state }}" type="text" class="form-control" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="bmd-label-floating">Zipcode</label>
                        <input name="shipping_zipcode" value="{{ $order->shipping_zipcode }}" type="text" class="form-control" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="bmd-label-floating">Phone</label>
                        <input name="shipping_phone" value="{{ $order->shipping_phone }}" type="text" class="form-control" disabled>
                    </div>
                </div>
            </div>

            <hr>
            <label style="color:rgb(58, 134, 221)" class="bmd-label-floating">Billing Information</label>
            <hr>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="bmd-label-floating">Full Name</label>
                        <input name="billing_fullname" value="{{ $order->billing_fullname }}" type="text" class="form-control" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="bmd-label-floating">Address</label>
                        <input name="billing_address" value="{{ $order->billing_address }}" type="text" class="form-control" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="bmd-label-floating">City</label>
                        <input name="billing_city" value="{{ $order->billing_city }}" type="text" class="form-control" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="bmd-label-floating">State/Country</label>
                        <input name="billing_state" value="{{ $order->billing_state }}" type="text" class="form-control" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="bmd-label-floating">Zipcode</label>
                        <input name="billing_zipcode" value="{{ $order->billing_zipcode }}" type="text" class="form-control" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="bmd-label-floating">Phone</label>
                        <input name="billing_phone" value="{{ $order->billing_phone }}" type="text" class="form-control" disabled>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row">

            </div>

            <button name="submit" type="submit" class="btn btn-primary pull-right">Update Order</button>

            <div class="col-md-4">
                <button class="btn btn-primary btn-block" onclick="md.showNotification('top','center')">Bottom Center</button>
            </div>
            <div class="clearfix"></div>
          </form>
        </div>
      </div>
    </div>

</div>@endsection

