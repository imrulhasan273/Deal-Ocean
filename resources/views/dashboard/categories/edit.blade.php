@php
$active='categories';
@endphp
@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Edit Country</h4>
          <p class="card-category">Complete your Shop</p>
        </div>
        <div class="card-body">
        <form method="POST" action="{{route('categories.update')}}">
        @csrf
            <div class="row">
                <div class="col-md-5" hidden>
                    <div class="form-group">
                      <label class="bmd-label-floating">ID</label>
                      <input name="id" value="{{ $category->id }}" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="bmd-label-floating">Parent</label>
                        <select name="parent_id" class="form-control">
                            <option style="color: rgb(19, 146, 219)" value="null">NULL</option>
                            @foreach ($categories as $cat)
                                <option style="color: rgb(19, 146, 219)" value="{{$cat->id}}" {{ $cat->id == $category->id ? 'selected':'' }}>{{$cat->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="bmd-label-floating">Name</label>
                        <input name="name" value="{{ $category->name }}" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="bmd-label-floating">Slug</label>
                        <input name="slug" value="{{ $category->slug }}" type="text" class="form-control">
                    </div>
                </div>
            </div>

            <button name="submit" type="submit" class="btn btn-primary pull-right">Update Category</button>
            <div class="clearfix"></div>
          </form>
        </div>
      </div>
    </div>

</div>@endsection

