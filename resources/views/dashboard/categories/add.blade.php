@php
$active='categories';
@endphp
@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Add Category</h4>
          <p class="card-category">Complete your Shop</p>
        </div>
        <div class="card-body">

        <form method="POST" action="{{route('categories.store')}}" enctype="multipart/form-data">
        @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="bmd-label-floating">Parent</label>
                        <select name="parent_id" class="form-control">
                            <option style="color: rgb(19, 146, 219)" value="null">Null</option>
                            @foreach ($categories as $category)
                                <option style="color: rgb(19, 146, 219)" value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="bmd-label-floating">Name</label>
                        <input name="name" value="" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="bmd-label-floating">Slug</label>
                        <input name="slug" value="" type="text" class="form-control">
                    </div>
                </div>
            </div>

            <button name="submit" type="submit" class="btn btn-primary pull-right">Add Category</button>

            <div class="clearfix"></div>
          </form>
        </div>
      </div>
    </div>

</div>
@endsection

