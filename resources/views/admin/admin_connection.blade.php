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

<body class="bg-gray-100">

    <main class=" my_min_height_administration text-center">
        <div class="connection_position">
            <div class="">
                <h1 class="dancing_font mb-6 text-6xl">Administration Connection</h1>
                <form action="{{ route('connection_admin') }}" method="POST">
                    @csrf
                    <div>
                        <input type="text" name="name" class="rounded w-full text-3xl mb-3" placeholder="Name">
                    </div>
                    <div>
                        <input type="password" name="password" class="rounded text-3xl w-full mb-3" placeholder="Password">
                    </div>
                    @if (Session::has('error'))
                        <div class="bg-red-500 text-white mb-3 text-md px-1 py-1 rounded">{{ Session::get('error') }}
                        </div>
                    @endif
                    @error('name')
                        <div class="bg-red-500 text-white mb-3 text-xl px-1 py-1 rounded">{{ $message }}</div>
                    @enderror
                    @error('password')
                        <div class="bg-red-500 text-white mb-3 text-xl px-1 py-1 rounded">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="px-4 mt-2 py-2 text-white bg-gray-800 rounded text-xl">Connect</button>
                </form>
            </div>
        </div>
    </main>

    <footer class="flex justify-center p-8 text-xl text-white bg-gray-500 border border-gray-500 nav_button_font">
        <div>
            <h3>Copyright &copy; 2020 Christophe Luciani, all Rights Reserved</h3>
        </div>
    </footer>
    </div>

</body>

</html>
