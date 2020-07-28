@component('mail::message')
# Shop Activation Request

Please activate shop. Here are shop details.

Shop Name : {{$shop->name}}
Shop Owner : {{$shop->seller->name}}


@component('mail::button', ['url' => url('/admin/shops')])
Manage Shops
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
