@component('mail::message')

@if($nb_notif == 1)
{{$user_name}} ({{$email_user}}) sent you a new message !
@else
You have {{$nb_notif}} messages unread from {{$user_name}} ({{$email_user}}) !
@endif

@component('mail::button', ['url' => $url_redirection])
Click here to answer your client now !
@endcomponent
