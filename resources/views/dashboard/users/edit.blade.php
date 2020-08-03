@php
$active='users';
@endphp
@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Edit User</h4>
          <p class="card-category">Complete your Shop</p>
        </div>
        <div class="card-body">
        <form method="POST" action="{{route('users.update')}}">
        @csrf
            <div class="row">
                <div class="col-md-5" hidden>
                    <div class="form-group">
                      <label class="bmd-label-floating">ID</label>
                      <input name="id" value="{{ $user->id }}" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group">
                        <label class="bmd-label-floating">Name</label>
                        <input name="name" value="{{ $user->name }}" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group">
                        <label class="bmd-label-floating">Email</label>
                        <input name="email" value="{{ $user->email }}" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-5" hidden>
                    <div class="form-group">
                        <label class="bmd-label-floating">ThisRole</label>
                        <input name="thisRole" value="{{ $thisRole->id }}" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="bmd-label-floating">Role</label>
                        <select name="role_id" class="form-control">
                            @foreach ($roles as $role)
                                <option style="color: rgb(19, 146, 219)" value="{{$role->id}}" {{ $thisRole->id == $role->id ? 'selected':'' }}>{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group">
                        <label class="bmd-label-floating">Photo</label>
                        <img style="height: 10%" src="{{asset('/storage/users/'.$user->photo)}}" alt="">
                    </div>
                </div>
            </div>

            <button name="submit" type="submit" class="btn btn-primary pull-right">Update User</button>
            <div class="clearfix"></div>
          </form>
        </div>
      </div>
    </div>

</div>@endsection

