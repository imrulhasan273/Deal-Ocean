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

            {{--  --}}

            <label for="description">Region</label>
            <select name="region" class="form-control RegionAjax" id="">
                <option value="0" disabled="true" selected="true">Select-</option>
                @foreach($regions as $region)
                    <option value="{{$region->id}}">{{$region->name}}</option>
                @endforeach
            </select>

            <label for="description">Country</label>
            <select name="country" class="form-control CountryAjax">
                <option value="0" disabled="true" selected="true">Select</option>
            </select>

            <div class="form-group">
                <label for="description">Location</label>
                <input name="location" type="text" class="form-control"  aria-describedby="helpId" placeholder="">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
