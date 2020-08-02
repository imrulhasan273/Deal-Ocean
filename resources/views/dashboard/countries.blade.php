@php
$active='countries';
$authRole = Auth::check() ? Auth::user()->role->pluck('name')->toArray() : [];
@endphp
@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-md-2">
    <a href="{{route('countries.add')}}" name="add" class="btn btn-primary pull-right">Add Country</a>
    </div>

    <div class="col-md-12">
      <div class="card card-plain">
        <div class="card-header card-header-primary">
          <h4 class="card-title mt-0">Country</h4>
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
                    Region
                </th>
                <th>
                    Edit
                </th>
                <th>
                    Delete
                </th>
              </thead>
              @foreach ($countries as $country)

                <tbody>
                    <tr>
                        <td>
                            {{$country->id}}
                        </td>
                        <td>
                            {{$country->name}}
                        </td>
                        <td>
                            {{$country->region->name}}
                        </td>
                        <td>
                            <a href="{{route('countries.edit',[$country->id])}}">Edit</a>
                        </td>
                        <td>
                            <a href="{{route('countries.destroy',[$country->id])}}">Delete</a>
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
