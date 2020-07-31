@php
$active='products';
@endphp
@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Add Product</h4>
          <p class="card-category">Complete your Shop</p>
        </div>
        <div class="card-body">

        <form method="POST" action="{{route('products.store')}}" enctype="multipart/form-data">
        @csrf
            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="bmd-label-floating">Product Name</label>
                        <input name="product_name" value="" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="bmd-label-floating"> Price</label>
                        <input name="product_price" value="" type="text" class="form-control">
                    </div>
                </div>

                @if (($role[0] == 'admin') || ($role[0] == 'super_admin'))
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="bmd-label-floating">Shop Name</label>
                        <select name="shop_id" class="form-control">
                            @foreach ($shops as $shop)
                                <option style="color: rgb(19, 146, 219)" value="{{$shop->id}}" {{ $shop->user_id == $user_id ? 'selected':'' }}>{{$shop->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @else
                <div class="col-md-6" hidden>
                    <div class="form-group">
                        <label class="bmd-label-floating">Shop Name</label>
                        <select name="shop_id" class="form-control">
                            @foreach ($shops as $shop)
                                <option style="color: rgb(19, 146, 219)" value="{{$shop->id}}" {{ $shop->user_id == $user_id ? 'selected':'' }}>{{$shop->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif

                <div class="col-md-12">
                    <div class="form-group">
                        <label class="bmd-label-floating">Product Description</label>
                        <input name="product_description" value="" type="text" class="form-control">
                    </div>
                </div>

                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                        </div>
                        <input name="product_img" type="file" class="">
                    </div>
                </div>

                <button name="submit" type="submit" class="btn btn-primary pull-right">Add Product</button>

            <div class="clearfix"></div>
          </form>
        </div>
      </div>
    </div>

</div>
@endsection

