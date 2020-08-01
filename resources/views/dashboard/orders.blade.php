@php
$active='orders';
$authRole = Auth::check() ? Auth::user()->role->pluck('name')->toArray() : [];
@endphp
@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card card-plain">
        <div class="card-header card-header-primary">
          <h4 class="card-title mt-0">Orders</h4>
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
                    Order No
                </th>
                <th>
                  User ID
                </th>
                <th>
                    Status
                </th>
                <th>
                  Sub Total
                </th>
                <th>
                    Discount
                </th>
                <th>
                    Grand Total
                </th>
                <th>
                    Item Count
                </th>
                <th>
                    Is Paid
                </th>
                <th>
                    Payment Method
                </th>
                <th>
                    Edit
                </th>
                <th>
                    Delete
                </th>
              </thead>
              @foreach ($orders as $order)

                <tbody>
                    <tr>
                    <td>
                        {{$order->id}}
                    </td>
                    <td>
                        {{$order->order_number}}
                    </td>
                    <td>
                        {{$order->user_id}}
                    </td>
                    <td>
                       {{$order->status}}
                    </td>
                    <td>
                        {{$order->sub_total}}
                    </td>
                    <td>
                        {{$order->discount}}
                    </td>
                    <td>
                        {{$order->grand_total}}
                    </td>
                    <td>
                       {{$order->item_count}}
                    </td>
                    <td>
                        {{$order->is_paid}}
                    </td>
                    <td>
                       {{$order->payment_method}}
                    </td>
                    <td>
                        <a href="{{route('orders.edit',[$order->id])}}">Edit</a>
                    </td>
                    <td>
                        <a href="{{route('orders.destroy',[$order->id])}}">Delete</a>
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

