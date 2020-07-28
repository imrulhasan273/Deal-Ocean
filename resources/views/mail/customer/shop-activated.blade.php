@component('mail::message')

# Congratulations

Your shop is now active

@component('mail::button', ['url' => route('dashboard.shops')])
Visit Your Shop
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
