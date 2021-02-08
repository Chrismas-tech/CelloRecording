@component('mail::message')

<h1>Dear {{$user_name}} !</h1>
<h1>{{$message}}</h1>

@component('mail::button', ['url' => 'http://cellorecording.ml/orders'])
Click here to check your order now !
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
