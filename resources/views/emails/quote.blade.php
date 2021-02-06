@component('mail::message')

<h1>{{ $user_name }} ! You received a quote from {{ $admin_name }}</h1>

<h2>Informations about your quote</h2>

<p>Title : {{ $datas['title'] }}<br>
Description : {{ $datas['description'] }}<br>
Days to complete the work : {{ $datas['nb_days'] }}<br>
Price in € : {{ $datas['price']/100}}</p>

@component('mail::button', ['url' => $url_redirection])
    Click here to check this quote right now !
@endcomponent

Thanks,
{{ config('app.name') }}
@endcomponent
