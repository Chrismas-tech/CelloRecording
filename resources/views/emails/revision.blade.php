@component('mail::message')

<h1>Our client {{$user_name}} ({{$email_user}}) is asking us a Revision !</h1>

@component('mail::button', ['url' => 'http://cellorecording.ml/orders_admin'])
Click here to check this revision now !
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
