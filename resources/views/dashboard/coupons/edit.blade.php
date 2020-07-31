@php
$active='products';
@endphp
@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Edit Coupon</h4>
          <p class="card-category">Complete your Shop</p>
        </div>
        <div class="card-body">

        <form method="POST" action="{{route('coupons.update')}}" enctype="multipart/form-data">
        @csrf
            <div class="row">
                <div class="col-md-5" hidden>
                    <div class="form-group">
                      <label class="bmd-label-floating">Coupon id</label>
                      <input name="coupon_id" value="{{ $coupon->id }}" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="bmd-label-floating"> Name</label>
                        <input name="coupon_name" value="{{ $coupon->name }}" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="bmd-label-floating"> Code</label>
                        <input name="coupon_code" value="{{ $coupon->code }}" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="bmd-label-floating"> Type</label>
                        <input name="coupon_type" value="{{ $coupon->type }}" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="bmd-label-floating"> Discount</label>
                        <input name="coupon_discount" value="{{ $coupon->discount }}" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="bmd-label-floating"> Description </label>
                        <input name="coupon_description" value="{{ $coupon->description }}" type="text" class="form-control">
                    </div>
                </div>

            </div>


            <button name="submit" type="submit" class="btn btn-primary pull-right">Update Coupon</button>
            <div class="clearfix"></div>
          </form>
        </div>
      </div>
    </div>

</div>
@endsection

