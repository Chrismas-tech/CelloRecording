<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CelloRecording.com</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>

    <div class="bg_cello_contact pb-20">

        <nav class="flex justify-between p-10">
            <div>
                <a class="px-2 py-3 mr-3 text-2xl text-white border border-white rounded hover:bg-gray-700 hover:text-green-400 nav_button_font"
                    href="/">CelloRecording Services 7/7</a>
                <a class="px-2 py-3 mr-3 text-2xl text-white border border-white rounded hover:bg-gray-700 hover:text-green-400 nav_button_font"
                    href="{{ route('contact') }}">Contact me</a>
            </div>
            <div>
                @if (Route::has('login'))
                    <div>
                        @auth
                            <a class="px-2 py-3 mr-3 text-2xl text-white border border-white rounded hover:bg-gray-700 hover:text-green-400 nav_button_font"
                                href="{{ url('/dashboard') }}">My Account</a>
                        @else
                            <a class="px-2 py-3 mr-3 text-2xl text-white border border-white rounded hover:bg-gray-700 hover:text-green-400 nav_button_font"
                                href="{{ route('login') }}">Login</a>
                            @if (Route::has('register'))
                                <a class="px-2 py-3 mr-3 text-2xl text-white border border-white rounded hover:bg-gray-700 hover:text-green-400 nav_button_font"
                                    href="{{ route('register') }}">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </nav>

        <div class="mt-5 text-white my_min_height_contact">
            <div class="text-center">
                <h1 class="mb-10 text-6xl title_jumbo dancing_font">Send me an email
                </h1>
            </div>

            @if (Session::has('send_success'))
            <div class="text-center mb-10 mt-10">
                <p class="title_jumbo text-5xl dancing_font">{{ Session::get('send_success') }}</p>
            </div>
            @endif

            <div class="text-3xl karma border p-8 border-white rounded max-w-4xl mx-auto">
                <form action="{{ route('send_contact_email') }}" method="POST">
                    @csrf
                    <div class="flex flex-col items-center">

                        <div class="mb-5 flex items-center w-full">
                            <label class="dancing_font mr-10" for="name">Name</label>
                            <input type="text" name="name"
                                class="focus:outline-none focus:ring focus:border-gray-300 placeholder_contact bg-white bg-opacity-5 text-white border border-white rounded w-full text-xl"
                                placeholder="Name...">
                        </div>
                    </div>

                    @error('name')
                        <div class="text-white text-xl mb-5 my_margin_left">{{ $message }}</div>
                    @enderror

                    <div class="flex flex-col items-center">
                        <div class="mb-5 flex items-center w-full">
                            <label class="dancing_font mr-10" for="email">Email</label>
                            <input type="email" required name="email"
                                class="focus:outline-none focus:ring focus:border-gray-300 placeholder_contact bg-white bg-opacity-5 text-white border border-white rounded w-full text-xl"
                                placeholder="Email...">
                        </div>
                    </div>

                    @error('email')
                        <div class="text-white text-xl mb-5 my_margin_left">{{ $message }}</div>
                    @enderror


                    <div class="flex items-start mb-5 w-full">
                        <label class="dancing_font mr-3" for="message">Message</label>
                        <textarea
                            class="focus:outline-none focus:ring focus:border-gray-300 placeholder_contact bg-white bg-opacity-5 text-white border border-white rounded w-full text-xl"
                            maxlength='1100' name="message" id="" cols="40" rows="10"
                            placeholder="Write your message here..."></textarea>
                    </div>
                    @error('message')
                        <div class="text-white text-xl mb-5 my_margin_left">{{ $message }}</div>
                    @enderror

                    <div class="text-center">
                        <button type="submit"
                            class="px-2 py-3 mr-3 text-2xl border border-white rounded hover:bg-gray-700 hover:text-green-400 nav_button_font">Send</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <footer class="flex justify-center p-8 text-xl text-white bg-gray-500 border border-gray-500 nav_button_font">
        <div>
            <h3>Copyright &copy; 2020 Christophe Luciani, all Rights Reserved</h3>
        </div>
    </footer>


</body>


</html>
