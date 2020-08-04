@php
$active='roles';
@endphp
@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Edit Role</h4>
          <p class="card-category">Complete your Shop</p>
        </div>
        <div class="card-body">

        <form method="POST" action="{{route('roles.update')}}" enctype="multipart/form-data">
        @csrf
            <div class="row">
                <div class="col-md-5" hidden>
                    <div class="form-group">
                      <label class="bmd-label-floating">Role ID</label>
                      <input name="id" value="{{ $role->id }}" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="bmd-label-floating"> Name</label>
                        <input name="name" value="{{ $role->name }}" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="bmd-label-floating"> Display Name</label>
                        <input name="display_name" value="{{ $role->display_name }}" type="text" class="form-control">
                    </div>
                </div>

            </div>


            <button name="submit" type="submit" class="btn btn-primary pull-right">Update Role</button>
            <div class="clearfix"></div>
          </form>
        </div>
      </div>
    </div>

</div>
@endsection
