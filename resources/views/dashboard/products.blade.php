@php
$active='products';
$authRole = Auth::check() ? Auth::user()->role->pluck('name')->toArray() : [];
@endphp
@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-md-2">
    <a name="add" class="btn btn-primary pull-right">Add Product</a>
    </div>

    <div class="col-md-12">
      <div class="card card-plain">
        <div class="card-header card-header-primary">
          <h4 class="card-title mt-0">Products</h4>
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
                    Description
                </th>
                <th>
                    Price
                </th>
                <th>
                    Shop ID
                </th>
                <th>
                    Shop Name
                </th>
                <th>
                     Cover Image
                </th>
                <th>
                    Edit
                </th>
                <th>
                    Delete
                </th>
              </thead>
              @foreach ($products as $product)

                @can('view', $product)

                <tbody>
                    <tr>
                        <td>
                            {{$product->id}}
                        </td>
                        <td>
                            {{$product->name}}
                        </td>
                        <td>
                            {{$product->description}}
                        </td>
                        <td>
                            {{$product->price}}
                        </td>
                        <td>
                            {{ $product->shop_id }}
                        </td>

                        <td>
                            {{ $product->shop->name }}
                        </td>

                        <td>
                            <img style="height: 10%" src="{{asset('/storage/products/'.$product->cover_img)}}" alt="">
                        </td>
                        <td>
                            <a href="{{route('products.edit',[$product->id])}}">Edit</a>
                        </td>
                        <td>
                            <a href="{{route('products.destroy',[$product->id])}}">Delete</a>
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

