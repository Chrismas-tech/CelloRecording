<nav class="bg-white border border-gray-200">

    <div id="menu_desktop" class="flex items-center justify-between mx-auto xl:container">

        <div>
            <x-navlink></x-navlink>
        </div>

        <div x-data="{open:false}" x-cloak class="flex items-center justify-center relative">
            <button @click="open = true" class="flex items-center md:mr-3 focus:outline-none">
                @auth
                    <h1 class="mr-5 text-3xl dancing_font capitalize mq_username_fs">{{ Auth::User()->name }}</h1>
                    @if (Auth::user()->avatar)
                        <img src="{{route('profile_image', Auth::user()->id)}}" class="mr-5 border border-gray-300 rounded-full w-16 h-16 circle mq_img_profile">
                    @else
                        <img src="{{ asset('img/noname_avatar.png') }}"
                            class="mr-5 border border-gray-400 rounded-full w-16 h-16 circle mq_img_profile" alt="avatar">
                    @endif
                    <img src="{{ asset('img/select_icon.png') }}" class="w-6 h-6 " alt="">
                </button>


                <div class="absolute top-16 right-2 text-indigo-500 bg-white rounded">
                    <ul x-show.transition="open" @click.away="open = false"
                        class="px-6 py-2 border-2 border-gray-200 rounded">
                        <li class="border-b border-gray-200 py-2 "><a href="{{ route('profile') }}"
                                class="text-xl ">Profile</a></li>

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-xl focus:outline-none py-2">Logout</button>
                        </form>
                    </ul>
                </div>
            @endauth
        </div>
    </div>

    @auth
        <div id="menu_responsive_user">
            <div class="flex justify-center p-5">
                <button class="flex items-center md:mr-3 focus:outline-none">
                    <h1 class="text-3xl mr-3 dancing_font capitalize">{{ Auth::User()->name }}</h1>
                    @if (Auth::user()->avatar)
                        <img src="{{route('profile_image', Auth::user()->id)}}"
                            class="mr-5 border border-gray-300 rounded-full w-28 h-28 circle">
                    @else
                        <img src="{{ asset('img/noname_avatar.png') }}"
                            class="mr-5 border border-gray-400 rounded-full w-28 h-28 circle" alt="avatar">
                    @endif
                    <img id="dropdown_icon" src="{{ asset('img/select_icon.png') }}" class="w-10 h-10" alt="">
                    <div>
                        <img id="cross_icon" src="{{ asset('img/cross.png') }}" class="w-10 hidden" alt="">
                    </div>
                </button>
            </div>
            <div id="hamburger" class="sm:text-sm xl:text-2xl hidden text-center text-indigo-500 bg-white rounded list-none">
                <x-nav_hamburger_user></x-nav_hamburger_user>
            </div>
        </div>
    @else
        <div id="menu_responsive_admin" class="sm:text-sm xl:text-2xl text-center">
            <x-nav_hamburger_admin></x-nav_hamburger_admin>
        </div>
    @endauth
</nav>


<script>
    $(document).ready(function() {
        // console.log('ready');
        $('#menu_responsive_user').click(function() {
            //   console.log('click');
            $('#hamburger').fadeToggle('slow')

            if ($('#dropdown_icon').hasClass('hidden')) {

                $('#dropdown_icon').removeClass('hidden')
                $('#cross_icon').addClass('hidden')
            } else {
                $('#dropdown_icon').addClass('hidden')
                $('#cross_icon').removeClass('hidden')
            }
        })
    });

</script>
