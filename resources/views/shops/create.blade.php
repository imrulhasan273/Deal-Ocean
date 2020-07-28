@extends('layouts.frontend')
@section('content')
<div style="margin-bottom: 30px;margin-top:30px" class="container">
    <div class="container">
        <h2>Submit Your Shop</h2>

        <form action="{{route('shops.store')}}" method="post">
            @csrf

            <div class="form-group">
                <label for="name">Name of Shop</label>
                <input type="text" class="form-control" name="name" id="" aria-describedby="helpId" placeholder="">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label for="description">Location</label>
                <select name="location" class="form-control">
                    @foreach ($locations as $location)
                        <option style="color: rgb(19, 146, 219)" value="{{$location->id}}" >{{$location->address}}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
