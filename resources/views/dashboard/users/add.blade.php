@php
$active='users';
@endphp
@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Add User</h4>
          <p class="card-category">Complete your Shop</p>
        </div>
        <div class="card-body">

        <form method="POST" action="{{route('users.store')}}" enctype="multipart/form-data">
        @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="bmd-label-floating">Name</label>
                        <input name="name" value="" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="bmd-label-floating">Email</label>
                        <input name="email" value="" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="bmd-label-floating">Role</label>
                        <select name="role_id" class="form-control">
                            @foreach ($roles as $role)
                                <option style="color: rgb(19, 146, 219)" value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group">
                        <label class="bmd-label-floating">Password</label>
                        <input name="password" value="" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group">
                        <label class="bmd-label-floating">Re-Password</label>
                        <input name="passwordConfirm" value="" type="text" class="form-control">
                    </div>
                </div>



            </div>



                <button name="submit" type="submit" class="btn btn-primary pull-right">Add User</button>

            <div class="clearfix"></div>
          </form>
        </div>
      </div>
    </div>

</div>
@endsection

