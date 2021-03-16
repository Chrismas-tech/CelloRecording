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
                            <a class="mq_mr_btn px-2 py-3 text-2xl text-black border border-black rounded hover:bg-gray-700 hover:text-green-400 nav_button_font"
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

        <div class="mq_jumbo_btn text-center jumbo_title_position">

            <div>
                <p class="jumbo_title_1 dancing_font">Professional Cello Recording Services - 7/7 days
                </p>
            </div>
            <div>
                <p class="mq_jumbo_title_1 dancing_font">Cello Recording Services <br> 7/7 days
                </p>
            </div>


            <div>
                <h1 class="mt-10 mb-16 jumbo_title_2 p-0 m-0 text-4xl font-bold karma">
                    Are you in need of a Professional Cellist for your next musical project ?
                </h1>
            </div>

            <div>
                <h1 class="mt-10 mb-10 mq_jumbo_title_2 p-0 m-0 text-4xl font-bold karma">
                   In need of a Professional Cellist for your next musical project ?
                </h1>
            </div>

            <div class="mt-10 mq_quote">
                <a class=" px-2 py-3 mr-3 text-2xl text-white border border-white rounded hover:bg-gray-700 hover:text-green-400 nav_button_font"
                    href="{{ url('/dashboard') }}">Get a quote for your project today !</a>
            </div>
        </div>
    </div>


    <menu class="mq_gray_menu flex items-center justify-center p-2 m-0 bg-gray-600 border-2 border-gray-800 ">
        <ul class="flex ">
            <li class="mt-3 mb-3"><a
                    class="px-2 py-3 mr-3 text-2xl text-white bg-gray-700 rounded hover:text-green-400 nav_button_font border border-gray-800"
                    href="#aboutme">About me</a></li>
            <li class="mt-3 mb-3"><a
                    class="px-2 py-3 mr-3 text-2xl text-white bg-gray-700 rounded hover:text-green-400 nav_button_font border border-gray-800"
                    href="#hdiw">How does it work ?</a></li>
            <li class="mt-3 mb-3"><a
                    class="px-2 py-3 mr-3 text-2xl text-white bg-gray-700 rounded hover:text-green-400 nav_button_font border border-gray-800"
                    href="#record_env">Recording Environment</a></li>
            <li class="mt-3 mb-3"><a
                    class="px-2 py-3 mr-3 text-2xl text-white bg-gray-700 rounded hover:text-green-400 nav_button_font border border-gray-800"
                    href="#pricing">Pricing</a></li>
            <li class="mt-3 mb-3"><a
                    class="px-2 py-3 mr-3 text-2xl text-white bg-gray-700 rounded hover:text-green-400 nav_button_font border border-gray-800"
                    href="#social_media">Social Medias</a></li>
        </ul>
    </menu>

    <div class="mq_font_size_presentation_text">

        <div class="px-5 py-16">
            <div class="xl:container mx-auto border-black rounded">
                <div id="aboutme" class="mq_about text-6xl pb-3 redressed_font">
                    <h1 class="nav_button_font mq_font_size_h1">About Me</h1>
                </div>

                <div class="flex text-xl rounded ">
                    <div class="mq_padding_presentation_text p-4 sm:p-8 text-xl rounded karma border border-black">
                        <p>
                            <iframe class="rounded ytb_vid ml-8 mb-8" width="640" height="360" src="https://www.youtube.com/embed/Ut_Rgayxop4?autoplay=1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                            </iframe>
                            My name is Christophe. I'm a professional cellist, pianist,
                            and composer born in 1990 in France (Nizza).<br><br>

                            I studied the violoncello in Paris where i graduated from the Bachelor of Music at the
                            <strong>Pôle
                            Supérieur Paris Boulogne-Billancourt</strong>, then i continued my education by going to the
                            University of Music and Performing Arts Graz for my Master Degree.

                            <br><br>
                            I worked many years with the top orchestra of World renown : ORF Vienna Radio Symphony
                            Orchestra
                            with which i performed in the world's most famous concert halls.

                            <br><br>

                            Since more than 4 years now, i'm working for music films, radios, and international
                            composers
                            through famous online musical platforms like Airgigs and Soundbetter.
                            <br><br>

                            I would be very glad to be a part of your next musical project !
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-red-500 px-5 py-16">
            <div class="xl:container mx-auto border-black rounded">
                <div class="mb-12">
                    <div id="hdiw" class="text-6xl text-gray-700 pb-3 rounded redressed_font">
                        <h1 class="text-white nav_button_font mq_font_size_h1">How does it work ?</h1>
                    </div>

                    <div class="mq_padding_presentation_text p-8 text-xl bg-white karma rounded border border-gray-300">
                        <p>
                            Create your own account and begin a conversation with me today !<br>
                            We will discuss about your musical project, your requirements and aesthetic wishes you
                            have and
                            i
                            will give my opinion as expert.
                        </p>
                        <br>
                        <p>
                            As every project is different, i'm making custom quotes for each musical projects.
                        </p>
                        <p>
                            Once we have common agreements, i will send you a quote that you can accept or decline
                            throught
                            your
                            personal space.
                        </p>
                        <br>
                        <p>
                            Once the work is done, your files will be available to download on your private account.
                        </p>
                    </div>
                </div>

                <div id="record_env" class="text-6xl pb-3 text-white rounded redressed_font">
                    <h1 class="nav_button_font mq_font_size_h1">Recording Environment</h1>
                </div>

                <div class="flex mq_padding_presentation_text text-xl karma">

                    <div class="mq_flex_welcome_page_recording_environment flex">
                        <div
                            class="w-4/12 mq_flex_welcome_page_recording_environment_width bg-white rounded  p-5 mr-3 ">
                            <div class="flex justify-center items-center">
                                <img src="{{ asset('img/violin_icon.ico') }}"
                                    class="w-16 h-auto icon_welcome_page_yellow" alt="">
                                <h1 class="text-4xl ml-3 dancing_font mq_title_recording_environment">My instrument
                                </h1>
                            </div>
                            <div class="mt-5">
                                <h2 class="mq_recording_environment">
                                    All of your <strong>tracks</strong> will be performed and recorded on my
                                    <strong>old
                                        acoustic cello</strong>.<br><br>

                                    If you pay attention to my video clips on <strong>Youtube</strong>, you will
                                    notice
                                    that the sound of the cello line is recorded on my real cello. <br><br>

                                    I rarely use my <strong>electric-cello</strong>, essentially for modern projects
                                    or
                                    when i have
                                    to make a video-clip outside.
                                </h2>
                            </div>
                        </div>

                        <div
                            class="w-6/12 mq_flex_welcome_page_recording_environment_width bg-white rounded  p-5 mr-3 ">
                            <div class="flex justify-center items-center">
                                <img src="{{ asset('img/music-record.ico') }}"
                                    class="w-16 h-auto icon_welcome_page_yellow" alt="">
                                <h1 class="text-4xl ml-3 dancing_font mq_title_recording_environment">Recording
                                    Software
                                </h1>
                            </div>
                            <div class="mt-5 mq_recording_environment">
                                <h2>
                                    Notice that i'm working only for <strong>CD quality</strong> album in
                                    <strong>Professional Studio</strong>.<br><br>

                                    In order to record the cello melodies in the best conditions, i'm using a famous
                                    music software with which i have a huge experience as sound producer too :
                                    <strong>Ableton Suite 10</strong>.

                                    <br><br>

                                    Once your work is achieved, i deliver you one or multiples audio files in the
                                    format
                                    of your choice :

                                    <br><br>
                                    <strong>WAV/High-Quality files</strong> (24 or 32 bits, 44100 hz or 48000 hz) or
                                    even <strong>MP3</strong>
                                    <br><br>
                                </h2>
                            </div>
                        </div>

                        <div
                            class="w-4/12 mq_flex_welcome_page_recording_environment_width bg-white rounded  p-5 ">
                            <div class="flex justify-center items-center">
                                <img src="{{ asset('img/microphone_icon.ico') }}"
                                    class="w-16 h-auto icon_welcome_page_yellow" alt="">
                                <h1 class="text-4xl ml-3 dancing_font mq_title_recording_environment">Microphone &
                                    Card
                                    sound</h1>
                            </div>
                            <div class="mt-5">
                                <h2 class="mq_recording_environment">
                                    Microphone : <strong>Senn­heiser MD441-U</strong><br>
                                    Card sound : <strong>Steinberg UR22</strong>
                                </h2>
                                <br>
                                <div class="flex items-center">
                                    <img src="{{ asset('img/dowload_icon_welcome_page.ico') }}"
                                        class="icon_welcome_page_download mr-2 w-10 h-auto">
                                    <a href="{{ route('download_demo_cello') }}"
                                        class="download_link_demo underline">Download a cello
                                        demo here (MP3)</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="px-5 py-16">
            <div class="xl:container mx-auto rounded">
                <div id="pricing" class="pb-3 text-6xl text-black rounded redressed_font">
                    <h1 class="nav_button_font mq_font_size_h1">Pricing</h1>
                </div>

                <div class="mq_padding_presentation_text p-8 text-xl karma bg-white rounded border border-black">
                    <p>
                        As every music project requires a particular attention according to the request (improvisation, accompaniment, compositions of cello melodies above your music, cello recordings following your music score, etc...), I decided to write an appropriate quote for each of my clients' projects.
                        <br>
                        The average cost by my side to record your cello part in professionnal studio is about 50€ for 1 minute recording.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <footer
        class="mq_footer flex justify-center p-8 text-xl text-white bg-gray-600 nav_button_font">
        <div>

            <div id="social_media" class="flex justify-center text-6xl pb-3 text-white rounded ">
                <h1 class="nav_button_font mq_font_size_h1">Social Medias</h1>
            </div>

            <div class="mq_social_icon flex justify-center">
                <div class="flex">
                    <a href="https://www.youtube.com/watch?v=Uj1OeaTc31w" target="_blank">
                        <img src="{{ asset('img/youtube_icon.png') }}" alt="" class="w-20 h-20 mr-10">
                    </a>
                    <a href="https://www.facebook.com/KrytofLuciani/" target="_blank">
                        <img src="{{ asset('img/facebook_icon.png') }}" alt="" class="w-20 h-20">
                    </a>
                </div>
            </div>

            <div class="mt-8">
                <h3>Copyright &copy; {{ date('Y') }} Christophe Luciani, all Rights Reserved</h3>
            </div>
        </div>

    </footer>
</body>

</html>
