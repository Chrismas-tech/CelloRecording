<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>

    <!-- AJAX -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
    
</head>

<body class="bg-gray-100 flex flex-col justify-between">
    <div>
    </div>
    
    <div class="mx-auto max-w-7xl">
        <div class="text-center">
            <h1 class="text-6xl text-gray-500">Error 403</h1>
            <h1 class="text-2xl text-gray-500 mt-5">Not authorized to access this page :(</h1>
        </div>
    </div>

    <footer class="flex justify-center p-8 text-xl text-white bg-gray-500 border border-gray-500 nav_button_font">
        <div>
            <h3>Copyright &copy; 2020 Christophe Luciani, all Rights Reserved</h3>
        </div>
    </footer>

</body>

</html>
