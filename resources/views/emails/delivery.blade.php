@component('mail::message')

<h1>Congratulations {{$user_name}} ! </h1>

Your order #{{$order_id}} is ready to download !

@component('mail::button', ['url' => 'http://cellorecording.test:8080/deliveries'])
Click here to check your order now !
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
