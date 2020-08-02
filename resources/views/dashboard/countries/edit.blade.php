@php
$active='countries';
@endphp
@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Edit Country</h4>
          <p class="card-category">Complete your Shop</p>
        </div>
        <div class="card-body">
        <form method="POST" action="{{route('countries.update')}}">
        @csrf
            <div class="row">
                <div class="col-md-5" hidden>
                    <div class="form-group">
                      <label class="bmd-label-floating">ID</label>
                      <input name="country_id" value="{{ $country->id }}" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group">
                        <label class="bmd-label-floating">Name</label>
                        <input name="country_name" value="{{ $country->name }}" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="bmd-label-floating">Region</label>
                        <select name="region_id" class="form-control">
                            @foreach ($regions as $region)
                                <option style="color: rgb(19, 146, 219)" value="{{$region->id}}" {{ $country->region_id == $region->id ? 'selected':'' }}>{{$region->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>


            <button name="submit" type="submit" class="btn btn-primary pull-right">Update Country</button>
            <div class="clearfix"></div>
          </form>
        </div>
      </div>
    </div>

</div>@endsection

