@php
$active='regions';
@endphp
@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Edit Region</h4>
          <p class="card-category">Complete your Shop</p>
        </div>
        <div class="card-body">

        <form method="POST" action="{{route('regions.update')}}" enctype="multipart/form-data">
        @csrf

            <div class="row">

                <div class="col-md-5" hidden>
                    <div class="form-group">
                      <label class="bmd-label-floating">ID</label>
                      <input name="region_id" value="{{ $region->id }}" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="bmd-label-floating"> Name</label>
                        <input name="region_name" value="{{ $region->name }}" type="text" class="form-control">
                    </div>
                </div>
            </div>

            <button name="submit" type="submit" class="btn btn-primary pull-right">Update Region</button>
            <div class="clearfix"></div>
          </form>
        </div>
      </div>
    </div>

</div>
@endsection

