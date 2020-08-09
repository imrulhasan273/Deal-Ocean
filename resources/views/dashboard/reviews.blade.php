@php
$active='reviews';
$authRole = Auth::check() ? Auth::user()->role->pluck('name')->toArray() : [];
@endphp
@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card card-plain">
        <div class="card-header card-header-primary">
          <h4 class="card-title mt-0">Reviews</h4>
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
                  Product ID
                </th>
                <th>
                    Product Name
                </th>
                <th>
                    User ID
                </th>
                <th>
                    User Name
                </th>
                <th>
                    Ratings
                </th>
                <th>
                  Comment
                </th>
                <th>
                    Date
                </th>
                <th>
                    Delete
                </th>
              </thead>
              @foreach ($reviews as $review)

                <tbody>
                    <tr>
                    <td>
                        {{$review->id}}
                    </td>
                    <td>
                        {{$review->product_id}}
                    </td>
                    <td>
                        {{$review->product->name}}
                    </td>
                    <td>
                        {{$review->user_id}}
                    </td>
                    <td>
                        {{$review->user->name}}
                    </td>
                    <td>
                       {{$review->rating}}
                    </td>
                    <td>
                        {{$review->comment}}
                    </td>
                    <td>
                        {{$review->created_at}}
                    </td>
                    <td>
                        <a href="{{route('reviews.destroy',[$review->id])}}">Delete</a>
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
