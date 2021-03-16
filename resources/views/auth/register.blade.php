<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 text-gray-500 fill-current" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <div class="flex justify-center items-center">
                    <img src="{{ asset('img/cello_login.jpg') }}" alt="" class="w-36 h-auto">
                </div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" required
                    autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')"
                    required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <div class="flex">
                    <x-input id="password" class="password_register_reveal block w-full rounded-r-none" type="password" name="password" required
                        autocomplete="new-password" />
                    <button type="button" class="reveal_password_register border border-gray-300 rounded-r">
                        <img src="{{ asset('img/eye.png') }}" alt="" class="w-7 h-auto eye_open_login">
                        <img class="eye_off_login eye_icon hidden w-7 h-auto" src="{{ asset('img/cross_eye.png') }}"
                            alt="" class="eye_icon hidden">
                    </button>
                </div>
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />
                <div class="flex">
                    <x-input id="password_confirmation" class="password_register_reveal block w-full w-full rounded-r-none" type="password"
                        name="password_confirmation" required />
                    <button type="button" class="reveal_password_register border border-gray-300 rounded-r">
                        <img src="{{ asset('img/eye.png') }}" alt="" class="w-7 h-auto eye_open_login">
                        <img class="eye_off_login eye_icon hidden w-7 h-auto" src="{{ asset('img/cross_eye.png') }}"
                            alt="" class="eye_icon hidden">
                    </button>
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="text-sm text-gray-600 underline hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
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
        $('.reveal_password_register').click(function() {

            //console.log('test');
            /* SI L'OEIL EST NORMAL -> ON CHANGE IMAGE + ON REVELE LE PASSWORD */
            if (!$('.eye_open_login').hasClass('hidden')) {
                $('.eye_open_login').addClass('hidden');
                $('.eye_off_login').removeClass('hidden');
                $('.password_register_reveal').attr('type', 'text');
                $('.password_register_reveal').attr('type', 'text');
            } else {
                $('.eye_open_login').removeClass('hidden');
                $('.eye_off_login').addClass('hidden');
                $('.password_register_reveal').attr('type', 'password');
                $('.password_register_reveal').attr('type', 'password');
            }
        });
    });

</script>
