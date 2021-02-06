@component('mail::message')

<h1>Congratulations {{$user_name}} ! </h1>
<h1>{{$message}}</h1>

@component('mail::button', ['url' => 'http://cellorecording.test:8080/orders'])
Click here to check your order now !
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
