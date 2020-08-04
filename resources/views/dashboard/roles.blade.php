@php
$active='roles';
$authRole = Auth::check() ? Auth::user()->role->pluck('name')->toArray() : [];
@endphp
@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-md-2">
    <a href="{{route('roles.add')}}" name="add" class="btn btn-primary pull-right">Add Role</a>
    </div>

    <div class="col-md-12">
      <div class="card card-plain">
        <div class="card-header card-header-primary">
          <h4 class="card-title mt-0">Role</h4>
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
                    Display Name
                </th>
                <th>
                    Edit
                </th>
                <th>
                    Delete
                </th>
              </thead>
              @foreach ($roles as $role)

                <tbody>
                    <tr>
                        <td>
                            {{$role->id}}
                        </td>
                        <td>
                            {{$role->name}}
                        </td>
                        <td>
                            {{$role->display_name}}
                        </td>
                        <td>
                            <a href="{{route('roles.edit',[$role->id])}}">Edit</a>
                        </td>
                        <td>
                            <a href="{{route('roles.destroy',[$role->id])}}">Delete</a>
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
