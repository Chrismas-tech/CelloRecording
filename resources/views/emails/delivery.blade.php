@component('mail::message')

<h1>Dear {{$user_name}} ! </h1>

Your order #{{$order_id}} is ready to download :)

@component('mail::button', ['url' => 'https://www.cellorecording.com//deliveries'])
Click here to check your order now !
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
