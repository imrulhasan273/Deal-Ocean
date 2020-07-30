@php
$active='products';
@endphp
@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Edit Product</h4>
          <p class="card-category">Complete your Shop</p>
        </div>
        <div class="card-body">

        <form method="POST" action="{{route('products.update')}}" enctype="multipart/form-data">
        @csrf
            <div class="row">
                <div class="col-md-5" hidden>
                    <div class="form-group">
                      <label class="bmd-label-floating">Product id</label>
                      <input name="product_id" value="{{ $product->id }}" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="bmd-label-floating">Product Name</label>
                        <input name="product_name" value="{{ $product->name }}" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="bmd-label-floating"> Price</label>
                        <input name="product_price" value="{{ $product->price }}" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="bmd-label-floating"> Shop ID</label>
                        <input name="shop_id" value="{{ $product->shop_id }}" type="text" class="form-control" disabled>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="bmd-label-floating">Shop Name</label>
                        <input name="shop_name" value="{{ $product->shop->name }}" type="text" class="form-control" disabled>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label class="bmd-label-floating">Product Description</label>
                        <input name="product_description" value="{{ $product->description }}" type="text" class="form-control">
                    </div>
                </div>


            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <img style="height: 3%" src="{{asset('/storage/products/'.$product->cover_img)}}" alt="">
                    </div>
                    <input name="product_img" type="file" class="form-control">
                </div>
            </div>

            <button name="submit" type="submit" class="btn btn-primary pull-right">Update Product</button>
            <div class="clearfix"></div>
          </form>
        </div>
      </div>
    </div>

</div>
@endsection

