@component('mail::message')

<h1>{{$message}}</h1>

@component('mail::button', ['url' => $url_redirection])
Click here to check your order now !
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
