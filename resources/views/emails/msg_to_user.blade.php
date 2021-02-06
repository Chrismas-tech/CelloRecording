@component('mail::message')

@if($nb_notif == 1)
{{$admin}} sent you a new message !
@else
You have {{$nb_notif}} messages unread from {{$admin}} !
@endif

@component('mail::button', ['url' => $url_redirection])
Click here to answer him now !
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
