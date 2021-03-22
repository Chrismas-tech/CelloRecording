<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {!! SEOMeta::generate() !!}

    <!-- Google Search Console Index -->
    <meta name="google-site-verification" content="t5GFMnr3HKSD8M0t1LKDoB_WCMrEVV6iB4LnivNvjHY" />

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('img/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('img/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('img/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('img/favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('img/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('img/favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('img/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('img/favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('img/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon/manifest.json') }}">

    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- Captcha -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>

    <div class="bg_cello_contact mq_contact_page pb-20">

        <nav class="flex justify-between bg-white p-10 mq_nav_padding">
            <div>
                <a class="mq_mr_btn-r px-2 py-3 mr-3 text-2xl text-black border border-black rounded hover:bg-gray-700 hover:text-green-400 nav_button_font"
                    href="/">CelloRecording Services 7/7</a>
                <a class="mq_mr_btn px-2 py-3 mr-3 text-2xl text-black border border-black rounded hover:bg-gray-700 hover:text-green-400 nav_button_font"
                    href="{{ url('/contact') }}">Contact me</a>
            </div>
            <div>
                @if (Route::has('login'))
                    <div>
                        @auth
                            <a class="mq_mr_btn px-2 py-3 mr-3 text-2xl text-black border border-black rounded hover:bg-gray-700 hover:text-green-400 nav_button_font"
                                href="{{ url('/dashboard') }}">My Account</a>
                        @else
                            <a class="mq_mr_btn px-2 py-3 mr-3 text-2xl text-black border border-black rounded hover:bg-gray-700 hover:text-green-400 nav_button_font"
                                href="{{ route('login') }}">Login</a>
                            @if (Route::has('register'))
                                <a class="px-2 py-3 text-2xl text-black border border-black rounded hover:bg-gray-700 hover:text-green-400 nav_button_font"
                                    href="{{ route('register') }}">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </nav>

        <div class="mt-5 text-white my_min_height_contact p-5 ">
            <div class="text-center">
                <h1 class="mb-10 text-6xl mq_font_email_title title_jumbo dancing_font">Send me an email
                </h1>
            </div>

            @if (Session::has('send_success'))
                <div class="flex justify-center mb-10 mt-10">
                    <p class="w-max title_jumbo mq_font_email_title text-5xl dancing_font text-green-400 bg-white px-2 py-3 rounded">
                        {{ Session::get('send_success') }}</p>
                </div>
            @endif

            <div class="text-3xl karma border p-8 border-white rounded max-w-4xl mx-auto bg-gray-800">
                <form action="{{ route('send_contact_email') }}" method="POST">
                    @csrf
                    <div class="flex flex-col items-center">

                        <div class="mb-5 md:flex items-center w-full">
                            <label class="dancing_font md:mr-10" for="name">Name</label>
                            <input type="text" name="name"
                                class="mq_input_contact_page focus:outline-none focus:ring focus:border-gray-300 placeholder_contact bg-white bg-opacity-5 text-white border border-white rounded w-full text-xl"
                                placeholder="Name...">
                        </div>
                    </div>

                    @error('name')
                        <div class="text-white text-xl mb-5 my_margin_left">{{ $message }}</div>
                    @enderror

                    <div class="flex flex-col items-center">
                        <div class="mb-5 md:flex items-center w-full">
                            <label class="dancing_font md:mr-10" for="email">Email</label>
                            <input type="email" required name="email"
                                class="mq_input_contact_page focus:outline-none focus:ring focus:border-gray-300 placeholder_contact bg-white bg-opacity-5 text-white border border-white rounded w-full text-xl"
                                placeholder="Email...">
                        </div>
                    </div>

                    @error('email')
                        <div class="text-white text-xl mb-5 my_margin_left">{{ $message }}</div>
                    @enderror


                    <div class="md:flex items-start mb-5 w-full">
                        <label class="dancing_font mr-3" for="message">Message</label>
                        <textarea
                            class=" focus:outline-none focus:ring focus:border-gray-300 placeholder_contact bg-white bg-opacity-5 text-white border border-white rounded w-full text-xl"
                            maxlength='1100' name="message" id="" cols="40" rows="10"
                            placeholder="Write your message here..."></textarea>
                    </div>

                    @error('message')
                        <div class="text-white text-xl mb-5 my_margin_left">{{ $message }}
                        </div>
                    @enderror

                    <div class="flex justify-center mb-4">
                        <div class="g-recaptcha" data-type="image"
                            data-sitekey="6Ldux4caAAAAAOleCshNf7Pl2fbDfk-EcHPy8dJf">
                        </div>
                    </div>

                    <div class="flex justify-center mb-3">
                        @if ($errors->has('g-recaptcha-response'))
                            <span class="text-white text-xl">
                                {{ $errors->first('g-recaptcha-response') }}
                            </span>
                        @endif
                    </div>

                    <div class="flex justify-center">
                        <button type="submit"
                            class="submit_contact_btn px-2 py-3 text-2xl border border-white rounded hover:bg-gray-700 hover:text-green-400 nav_button_font">Send
                        </button>
                    </div>

                    <div class="text-center">

                    </div>

                </form>
            </div>
        </div>
    </div>

    <footer
        class="mq_footer flex justify-center p-8 text-xl text-white bg-gray-500 border border-gray-500 nav_button_font">
        <div>
            <h3>Copyright &copy; {{ date('Y') }} Christophe Luciani, all Rights Reserved</h3>
        </div>
    </footer>


</body>


</html>
