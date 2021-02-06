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
    <div class="bg_cello mq_jumbo_btn">
        <nav class="flex justify-between p-10 mq_nav_padding">
            <div class="">
                <a class="mq_mr_btn-r px-2 py-3 mr-3 text-2xl text-white border border-white rounded hover:bg-gray-700 hover:text-green-400 nav_button_font"
                    href="/">CelloRecording Services 7/7</a>
                <a class="mq_mr_btn px-2 py-3 mr-3 text-2xl text-white border border-white rounded hover:bg-gray-700 hover:text-green-400 nav_button_font"
                    href="{{ url('/contact') }}">Contact me</a>
            </div>
            <div class="">
                @if (Route::has('login'))
                    <div class="">
                        @auth
                            <a class="mq_mr_btn px-2 py-3 mr-3 text-2xl text-white border border-white rounded hover:bg-gray-700 hover:text-green-400 nav_button_font"
                                href="{{ url('/dashboard') }}">My Account</a>
                        @else
                            <a class="mq_mr_btn px-2 py-3 mr-3 text-2xl text-white border border-white rounded hover:bg-gray-700 hover:text-green-400 nav_button_font"
                                href="{{ route('login') }}">Login</a>
                            @if (Route::has('register'))
                                <a class="px-2 py-3 text-2xl text-white border border-white rounded hover:bg-gray-700 hover:text-green-400 nav_button_font"
                                    href="{{ route('register') }}">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </nav>

        <div class="mq_jumbo_btn text-center jumbo_title_position">
            <div>
                <p class="jumbo_title_1 dancing_font">Professional Cello Recording Services - 7/7 days
                </p>
            </div>
            <div class="mt-3">
                <h1 class="jumbo_title_2 p-0 m-0 text-4xl font-bold karma">
                    Are you in need of a Professional Cellist for your next musical project ?
                </h1>
            </div>

            <div class="mt-10 mq_quote">
                <a class=" px-2 py-3 mr-3 text-2xl text-white border border-white rounded hover:bg-gray-700 hover:text-green-400 nav_button_font"
                    href="{{ url('/dashboard') }}">Get a quote for your project today !</a>
            </div>
        </div>
    </div>


    <menu class="mq_gray_menu flex items-center justify-center p-2 m-0 bg-gray-500">
        <ul class="flex ">
            <li class="mt-3 mb-3"><a
                    class="px-2 py-3 mr-3 text-2xl text-white bg-gray-700 rounded hover:text-green-400 nav_button_font"
                    href="#aboutme">About me</a></li>
            <li class="mt-3 mb-3"><a
                    class="px-2 py-3 mr-3 text-2xl text-white bg-gray-700 rounded hover:text-green-400 nav_button_font"
                    href="#hdiw">How does it work ?</a></li>
            <li class="mt-3 mb-3"><a
                    class="px-2 py-3 mr-3 text-2xl text-white bg-gray-700 rounded hover:text-green-400 nav_button_font"
                    href="#record_env">Recording Environment</a></li>
            <li class="mt-3 mb-3"><a
                    class="px-2 py-3 mr-3 text-2xl text-white bg-gray-700 rounded hover:text-green-400 nav_button_font"
                    href="#pricing">Pricing</a></li>
            <li class="mt-3 mb-3"><a
                    class="px-2 py-3 mr-3 text-2xl text-white bg-gray-700 rounded hover:text-green-400 nav_button_font"
                    href="#social_media">Social Medias</a></li>
        </ul>
    </menu>


    <div class="bg-yellow-50 mq_txt_services">
        <div class=" xl:container px-5 pt-3 pb-10 mx-auto border-black rounded ">
            
            <div id="aboutme" class="mq_about mt-10 text-3xl text-gray-700 rounded courgette_font">
                <h1>About Me</h1>
            </div>

            <div class="mq_display flex text-xl rounded">
                <div class="mq_text_margin p-8 mr-8 text-xl bg-white rounded karma border border-gray-300">
                    <p>My name is Christophe. I'm a professional cellist, pianist,
                        and composer born in 1990 in France (Nizza).</p><br>

                    <p>I studied the violoncello in Paris where i graduated from the Bachelor of Music at the
                        "Pôle
                        Supérieur Paris Boulogne-Billancourt", then i continued my education by going to the
                        University of Music and Performing Arts Graz for my Master Degree.</p>
                    <p>
                        <br>
                        I worked many years with the top orchestra of World renown : ORF Vienna Radio Symphony Orchestra
                        with which i performed in the world's most famous concert halls.
                    </p>
                    <br>
                    <p>
                        Since more than 4 years now, i'm working for music films, radios, and international composers
                        through famous online musical platforms like Airgigs and Soundbetter. </p>
                    <br>
                    <p>
                        I would be very glad to be a part of your next musical project !
                    </p>
                </div>
                <div>
                    <iframe class=" rounded ytb_vid" width="760" height="415"
                        src="https://www.youtube.com/embed/Ut_Rgayxop4?autoplay=1;&mute=1" allow="fullscreen;"></iframe>
                </div>

            </div>


            <div>
            <div id="hdiw" class="mt-10 text-3xl text-gray-700 rounded courgette_font">
                <h1>How does it work ?</h1>
            </div>


            <div class="mq_text_margin p-8 mr-8 text-xl bg-white karma rounded border border-gray-300">
                <p>
                    Create your own account and begin a conversation with me today !<br>
                    We will discuss about your musical project, your requirements and aesthetic wishes you have and i
                    will give my opinion as expert.
                </p>
                <br>
                <p>
                    As every project is different, i'm making custom quotes for each musical projects.
                </p>
                <p>
                    Once we have common agreements, i will send you a quote that you can accept or decline throught your
                    personal space.
                </p>
                <br>
                <p>
                    Once the work is done, your files will be available to download on your private account.
                </p>
            </div>

            <div id="record_env" class="mt-10 text-3xl text-gray-700 rounded courgette_font">
                <h1>Recording Environment</h1>
            </div>

            <div class="mq_text_margin p-8 mr-8 text-xl bg-white rounded border border-gray-300 karma">
                <p>
                    I'm working only for CD quality album in professional studio on my real old cello, that's why i'm used to deliver WAV-HQ audio music files to my clients.
                </p>
            </div>

            <div id="pricing" class="mt-10 text-3xl text-gray-700 rounded courgette_font">
                <h1>Pricing</h1>
            </div>

            <div class="mq_text_margin p-8 mr-8 text-xl karma bg-white rounded border border-gray-300">
                <p>
                    I'm working only for CD quality album in professional studio on my real old cello, that's why i'm used to deliver WAV-HQ audio music files to my clients.
                </p>
            </div>

            <div id="social_media" class="mt-10 text-3xl text-gray-700 rounded courgette_font"">
            <h1 >Social Medias</h1>

        </div>
        
        <div class="mq_social_icon p-8 mr-8">
                <div class="flex">
                    <a href="https://www.youtube.com/watch?v=Uj1OeaTc31w">
                        <img src="{{ asset('img/youtube_icon.png') }}" alt="" class="w-20 h-20 mr-10">
                    </a>
                    <a href="https://www.facebook.com/KrytofLuciani/">
                        <img src="{{ asset('img/facebook_icon.png') }}" alt="" class="w-20 h-20">
                    </a>
                </div>
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
