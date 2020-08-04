@php
$active='sliders';
@endphp
@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Edit Slider</h4>
          <p class="card-category">Complete your Shop</p>
        </div>
        <div class="card-body">

        <form method="POST" action="{{route('sliders.update')}}" enctype="multipart/form-data">
        @csrf
            <div class="row">
                <div class="col-md-5" hidden>
                    <div class="form-group">
                      <label class="bmd-label-floating">ID</label>
                      <input name="id" value="{{ $slider->id }}" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="bmd-label-floating">Title</label>
                        <input name="title" value="{{ $slider->title }}" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="bmd-label-floating"> Name</label>
                        <input name="name" value="{{ $slider->name }}" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="bmd-label-floating">Price</label>
                        <input name="price" value="{{ $slider->price }}" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label class="bmd-label-floating"> Description</label>
                        <input name="description" value="{{ $slider->description }}" type="text" class="form-control">
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <img style="height: 100px" src="{{asset('/storage/slider/'.$slider->slider_img)}}" alt="">
                    </div>
                    <input name="slider_img" type="file" class="form-control">
                </div>
            </div>

            <button name="submit" type="submit" class="btn btn-primary pull-right">Update Slider</button>
            <div class="clearfix"></div>
          </form>
        </div>
      </div>
    </div>

</div>
@endsection

