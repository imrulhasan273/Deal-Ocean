@php
$active='shops';
@endphp
@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Edit Shop</h4>
          <p class="card-category">Complete your Shop</p>
        </div>
        <div class="card-body">
        <form method="POST" action="{{route('shops.update')}}">
        @csrf
            <div class="row">
                <div class="col-md-5" hidden>
                    <div class="form-group">
                      <label class="bmd-label-floating">Shop id</label>
                      <input name="shop_id" value="{{ $shop->id }}" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group">
                        <label class="bmd-label-floating">Shop Name</label>
                        <input name="shop_name" value="{{ $shop->name }}" type="text" class="form-control" disabled>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="bmd-label-floating">Owner</label>
                        <input name="seller_name" value="{{ $shop->seller->name }}" type="text" class="form-control" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="bmd-label-floating">Is Active</label>
                        <select  name="is_active" class="form-control">
                            <option style="color: rgb(20, 211, 77)" value="1" {{ $shop->is_active == '1' ? 'selected':'' }}>Active</option>
                            <option style="color: rgb(231, 9, 9)" value="0" {{ $shop->is_active == '0' ? 'selected':'' }}>In-active</option>
                        </select>
                    </div>
                </div>


                <div class="col-md-12">
                    <div class="form-group">
                        <label class="bmd-label-floating">Description</label>
                        <input name="description" value="{{ $shop->description }}" type="text" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <label class="bmd-label-floating">Rating</label>
                    <input name="rating" value="{{ $shop->rating }}" type="text" class="form-control" disabled>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="bmd-label-floating">Location</label>
                        <select name="location" class="form-control">
                            @foreach ($locations as $location)
                                <option style="color: rgb(19, 146, 219)" value="{{$location->id}}" {{ $shop->location_id == $location->id ? 'selected':'' }}>{{$location->address}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>

            <button name="submit" type="submit" class="btn btn-primary pull-right">Update Shop</button>
            <div class="clearfix"></div>
          </form>
        </div>
      </div>
    </div>

</div>@endsection

