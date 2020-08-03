@php
$active='locations';
@endphp
@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Add Location</h4>
          <p class="card-category">Complete your Shop</p>
        </div>
        <div class="card-body">

        <form method="POST" action="{{route('locations.store')}}" enctype="multipart/form-data">
        @csrf
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="bmd-label-floating">Address</label>
                        <input name="address" value="" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="bmd-label-floating">Postal Code</label>
                        <input name="postal_code" value="" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="bmd-label-floating">Country</label>
                        <select name="country_id" class="form-control">
                            @foreach ($countries as $country)
                                <option style="color: rgb(19, 146, 219)" value="{{$country->id}}">{{$country->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

                <button name="submit" type="submit" class="btn btn-primary pull-right">Add Location</button>

            <div class="clearfix"></div>
          </form>
        </div>
      </div>
    </div>

</div>
@endsection

