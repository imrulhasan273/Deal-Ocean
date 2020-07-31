@php
$active='coupons';
$authRole = Auth::check() ? Auth::user()->role->pluck('name')->toArray() : [];
@endphp
@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-md-2">
    <a href="{{route('coupons.add')}}" name="add" class="btn btn-primary pull-right">Add Coupon</a>
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
                    Code
                </th>
                <th>
                    Type
                </th>
                <th>
                    Discount
                </th>
                <th>
                    Description
                </th>
                <th>
                    Edit
                </th>
                <th>
                    Delete
                </th>
              </thead>
              @foreach ($coupons as $coupon)

                {{-- @can('view', $product) --}}

                <tbody>
                    <tr>
                        <td>
                            {{$coupon->id}}
                        </td>
                        <td>
                            {{$coupon->name}}
                        </td>
                        <td>
                            {{$coupon->code}}
                        </td>
                        <td>
                            {{$coupon->type}}
                        </td>
                        <td>
                            {{ $coupon->discount }}
                        </td>
                        <td>
                            {{ $coupon->description }}
                        </td>
                        <td>
                            <a href="{{route('coupons.edit',[$coupon->id])}}">Edit</a>
                        </td>
                        <td>
                            <a href="{{route('coupons.destroy',[$coupon->id])}}">Delete</a>
                        </td>
                    </tr>
                </tbody>

                {{-- @endcan --}}

              @endforeach
            </table>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
