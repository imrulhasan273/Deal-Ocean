@php
$active='shops';
$authRole = Auth::check() ? Auth::user()->role->pluck('name')->toArray() : [];
@endphp
@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card card-plain">
        <div class="card-header card-header-primary">
          <h4 class="card-title mt-0">Shop Table</h4>
          <p class="card-category"> Here is a subtitle for this table</p>
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
                  Owner
                </th>
                <th>
                  Is Active
                </th>
                <th>
                    Ratings
                </th>
                <th>
                    Location
                </th>
                <th>
                    Edit
                </th>
                <th>
                    @if(($authRole[0] == 'admin') || ($authRole[0] == 'super_admin'))
                    Delete
                    @endif
                </th>
              </thead>
              @foreach ($shops as $shop)

                @can('view', $shop)

                <tbody>
                    <tr>
                    <td>
                        {{$shop->id}}
                    </td>
                    <td>
                        {{$shop->name}}
                    </td>
                    <td>
                        {{$shop->seller->name}}
                    </td>
                    <td>
                        @if($shop->is_active)
                        Yes
                        @else
                        No
                        @endif
                    </td>
                    <td>
                        {{$shop->rating}}
                    </td>
                    <td>
                        {{$shop->location->address}}
                    </td>
                    <td>
                        <a href="{{route('shops.edit',[$shop->id])}}">Edit</a>
                    </td>
                    <td>
                        @can('delete', $shop)
                        <a href="{{route('shops.destroy',[$shop->id])}}">Delete</a>
                        @endcan
                    </td>
                    </tr>
                </tbody>

                @endcan

              @endforeach
            </table>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection

