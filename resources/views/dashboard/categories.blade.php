@php
$active='categories';
$authRole = Auth::check() ? Auth::user()->role->pluck('name')->toArray() : [];
@endphp
@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-md-2">
    <a href="{{route('categories.add')}}" name="add" class="btn btn-primary pull-right">Add Category</a>
    </div>

    <div class="col-md-12">
      <div class="card card-plain">
        <div class="card-header card-header-primary">
          <h4 class="card-title mt-0">Category</h4>
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
                    Parent ID
                </th>
                <th>
                    Name
                </th>
                <th>
                    Slug
                </th>
                <th>
                    Edit
                </th>
                <th>
                    Delete
                </th>
              </thead>
              @foreach ($categories as $category)

                <tbody>
                    <tr>
                        <td>
                            {{$category->id}}
                        </td>
                        <td>
                            {{$category->parent_id}}
                        </td>
                        <td>
                            {{$category->name}}
                        </td>
                        <td>
                            {{$category->slug}}
                        </td>
                        <td>
                            <a href="{{route('categories.edit',[$category->id])}}">Edit</a>
                        </td>
                        <td>
                            <a href="{{route('categories.destroy',[$category->id])}}">Delete</a>
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
