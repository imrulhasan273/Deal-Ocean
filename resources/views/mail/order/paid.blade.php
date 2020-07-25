@extends('mail.template')
@section('invoice')
@component('mail::button', ['url' => ''])
Print
@endcomponent

@component('mail::layout')

{{-- Start Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
    Invoice Page
@endcomponent
@endslot
{{-- End Header --}}


# Invoice Status: Paid
<hr>
Shipping Information
<hr>
<h6> Name: {{$order->shipping_fullname}} <br>
     City: {{$order->shipping_city }}<br>
     Address: {{ $order->shipping_address }}<br>
     Country: {{ $order->shipping_state }}<br>
     Cell: {{$order->shipping_phone }}<br>
</h6>
<hr>
Invoice Information
<hr>
<h6> Order No: {{$order->order_number }}<br>
     Payment Method: {{$order->payment_method }}<br>
     Transection ID: {{$order->transection_id }}<br>
</h6>
<hr>


<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Product name</th>
            <th>quantity</th>
            <th>price</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->product as $item)
        <tr>
            <td scope="row">{{ $item->name }}</td>
            <td>{{ $item->pivot->quantity }}</td>
            <td>{{ $item->pivot->price }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<hr>
Total Items: {{ $order->item_count }}
<br>
Sub Total : {{ $order->sub_total }}
<br>
Discount : {{ $order->discount }}
<br>
Grand Total : {{ $order->grand_total }}

<hr>
Date: {{ $order->updated_at }}
<br>
Thanks for your purchase, {{ config('app.name') }}

{{-- Start Footer --}}
@slot('footer')
@component('mail::footer')
© 2020 Deal Ocean. All rights reserved.
@endcomponent
@endslot
{{-- End Footer --}}

@endcomponent
@endsection
