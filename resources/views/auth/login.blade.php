<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 text-gray-500 fill-current" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <div class="flex justify-center items-center">
                    <img src="{{ asset('img/cello_login.jpg') }}" alt="" class="w-36 h-auto">
                </div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required
                    autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />
                <div class="flex">
                    <x-input id="password" class="password_login_reveal block w-full rounded-r-none" type="password" name="password" required
                        autocomplete="current-password" />
                    <button type="text"class="reveal_password_login border border-gray-300 rounded-r">
                        <img src="{{ asset('img/eye.png') }}" alt="" class="w-7 h-auto eye_open_login">
                        <img class="eye_off_login eye_icon hidden w-7 h-auto" src="{{ asset('img/cross_eye.png') }}" alt=""
                            class="eye_icon hidden">
                    </button>
                </div>
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="text-indigo-600 border-gray-300 rounded shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="text-sm text-gray-600 underline hover:text-gray-900"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml-3">
                    Login
                </x-button>

            </div>
        </form>
        <div class="flex justify-center mt-8">
            <a href="/" class="px-4 py-2 text-white bg-gray-800 rounded">Back to the welcome page</a>
        </div>
    </x-auth-card>
</x-guest-layout>


<script>
    $('document').ready(function() {

        //console.log('test1');
        /* REVELER LE PASSWORD login*/
        $('.reveal_password_login').click(function() {

           //console.log('test');
            /* SI L'OEIL EST NORMAL -> ON CHANGE IMAGE + ON REVELE LE PASSWORD */
            if (!$('.eye_open_login').hasClass('hidden')) {
                $('.eye_open_login').addClass('hidden');
                $('.eye_off_login').removeClass('hidden');
                $('.password_login_reveal').attr('type', 'text');
            } else {
                $('.eye_open_login').removeClass('hidden');
                $('.eye_off_login').addClass('hidden');
                $('.password_login_reveal').attr('type', 'password');
            }
        });
    });
</script>
