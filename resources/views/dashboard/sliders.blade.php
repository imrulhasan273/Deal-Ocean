@php
$active='sliders';
$authRole = Auth::check() ? Auth::user()->role->pluck('name')->toArray() : [];
@endphp
@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-md-2">
    <a href="{{route('sliders.add')}}" name="add" class="btn btn-primary pull-right">Add Slider</a>
    </div>

    <div class="col-md-12">
      <div class="card card-plain">
        <div class="card-header card-header-primary">
          <h4 class="card-title mt-0">Sliders</h4>
          <p class="card-category"> All the shops appear here</p>
        </div>

        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover">
              <thead class="">
                <th>
                    ID
                </th>
                <th>
                    Title
                </th>
                <th>
                    Name
                </th>
                <th>
                    Description
                </th>
                <th>
                    Price
                </th>
                <th>
                    Photo
                </th>
                <th>
                    Edit
                </th>
                <th>
                    Delete
                </th>
              </thead>
              @foreach ($sliders as $slider)

                <tbody>
                    <tr>
                        <td>
                            {{$slider->id}}
                        </td>
                        <td>
                            {{$slider->title}}
                        </td>
                        <td>
                            {{$slider->name}}
                        </td>
                        <td>
                            {{$slider->description}}
                        </td>
                        <td>
                            {{ $slider->price }}
                        </td>
                        <td>
                            <img style="height: 10%" src="{{asset('/storage/slider/'.$slider->slider_img)}}" alt="">
                        </td>
                        <td>
                            <a href="{{route('sliders.edit',[$slider->id])}}">Edit</a>
                        </td>
                        <td>
                            <a href="{{route('sliders.destroy',[$slider->id])}}">Delete</a>
                        </td>
                    </tr>
                </tbody>

              @endforeach
            </table>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection

