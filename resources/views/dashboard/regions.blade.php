@php
$active='regions';
$authRole = Auth::check() ? Auth::user()->role->pluck('name')->toArray() : [];
@endphp
@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-md-2">
    <a href="{{route('regions.add')}}" name="add" class="btn btn-primary pull-right">Add Region</a>
    </div>

    <div class="col-md-12">
      <div class="card card-plain">
        <div class="card-header card-header-primary">
          <h4 class="card-title mt-0">Coupons</h4>
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
                    Name
                </th>
                <th>
                    Edit
                </th>
                <th>
                    Delete
                </th>
              </thead>
              @foreach ($regions as $region)

                <tbody>
                    <tr>
                        <td>
                            {{$region->id}}
                        </td>
                        <td>
                            {{$region->name}}
                        </td>
                        <td>
                            <a href="{{route('regions.edit',[$region->id])}}">Edit</a>
                        </td>
                        <td>
                            <a href="{{route('regions.destroy',[$region->id])}}">Delete</a>
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
