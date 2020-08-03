@php
$active='locations';
$authRole = Auth::check() ? Auth::user()->role->pluck('name')->toArray() : [];
@endphp
@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-md-2">
    <a href="{{route('locations.add')}}" name="add" class="btn btn-primary pull-right">Add Location</a>
    </div>

    <div class="col-md-12">
      <div class="card card-plain">
        <div class="card-header card-header-primary">
          <h4 class="card-title mt-0">Location</h4>
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
                    Address
                </th>
                <th>
                    Postal Code
                </th>
                <th>
                    Country
                </th>
                <th>
                    Edit
                </th>
                <th>
                    Delete
                </th>
              </thead>
              @foreach ($locations as $location)

                <tbody>
                    <tr>
                        <td>
                            {{$location->id}}
                        </td>
                        <td>
                            {{$location->address}}
                        </td>
                        <td>
                            {{$location->postal_code}}
                        </td>
                        <td>
                            {{$location->country->name}}
                        </td>
                        <td>
                            <a href="{{route('locations.edit',[$location->id])}}">Edit</a>
                        </td>
                        <td>
                            <a href="{{route('locations.destroy',[$location->id])}}">Delete</a>
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
