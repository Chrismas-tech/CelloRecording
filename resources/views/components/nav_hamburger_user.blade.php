@php
/*User*/
$active ="border-indigo-500 bg-indigo-100 text-blue-700 font-bold";
$not_active ="border-indigo-200";
@endphp

<div class="border-t-2 border-indigo-200">
    <a href="{{ route('profile') }}">
        <li
            class="hover:text-purple-600 relative p-3 border-b-2 hover:border-indigo-500 {{ Route::currentRouteName() == 'profile' ? $active : $not_active }}">
            Profile
            <div class="absolute bottom-1 right-3 flex items-center">
                <img src="{{ asset('img/profile.png') }}" alt="" class="w-8">
            </div>
        </li>
    </a>

    <form action="{{ route('logout') }}" method="POST"
        class="border-b-2 hover:border-indigo-500 relative hover:text-purple-600 {{ Route::currentRouteName() == 'logout' ? $active : $not_active }}">
        @csrf
        <button type="submit" class="p-3 ">Logout
            <div class="absolute bottom-1 right-3 flex items-center">
                <img src="{{ asset('img/shutdown.png') }}" alt="" class="w-8">
            </div>
        </button>
    </form>

    <a href="{{ route('dashboard') }}">
        <li
            class="hover:text-purple-600 relative p-3 border-b-2 hover:border-indigo-500 {{ Route::currentRouteName() == 'dashboard' ? $active : $not_active }}">
            Dashboard


            <div class="absolute bottom-1 right-3 flex items-center">
                <img src="{{ asset('img/home_icon.png') }}" alt="" class="w-8">
            </div>
        </li>
    </a>
    <a href="{{ route('conversation') }}" class="">
        <li
            class="hover:text-purple-600 relative p-3  border-b-2 hover:border-indigo-500 {{ Route::currentRouteName() == 'conversation' ? $active : $not_active }}">
            Conversations

            <div class="absolute bottom-1 right-3 flex items-center">

                <img src="{{ asset('img/messages_icon.png') }}" alt="" class="w-8">
                @if (App\Http\Controllers\UserController::notifications() > 0)
                    <div class="flex items-center justify-center text-black">
                        <p class="text-sm font-bold">({{ App\Http\Controllers\UserController::notifications() }})</p>
                    </div>
                @endif
            </div>
        </li>
    </a>
    <a href="{{ route('quotes-received') }}">
        <li
            class="hover:text-purple-600 relative p-3  border-b-2 hover:border-indigo-500 {{ Route::currentRouteName() == 'quotes-received' ? $active : $not_active }}">
            Your Quotes
            <div class="absolute bottom-1 right-3 flex items-center">

                <img src="{{ asset('img/quotes_icon.png') }}" alt="" class="w-9">
                @if (App\Http\Controllers\UserController::quotes_notifications() > 0)
                    <div class="flex items-center justify-center text-black">
                        <p class="text-sm font-bold">({{ App\Http\Controllers\UserController::quotes_notifications() }})
                        </p>
                    </div>
                @endif
            </div>
        </li>
    </a>
    <a href="{{ route('orders') }}">
        <li
            class="hover:text-purple-600 relative p-3 border-b-2 hover:border-indigo-500 {{ Route::currentRouteName() == 'orders' ? $active : $not_active }}">
            My Orders

            <div class="absolute bottom-1 right-3 flex items-center">
                <img src="{{ asset('img/order_icon.png') }}" alt="" class="w-8">
                @if (App\Http\Controllers\UserController::order_notifications() > 0)
                    <div class=" flex items-center justify-center text-black ">
                        <p class="text-sm font-bold">({{ App\Http\Controllers\UserController::order_notifications() }})
                        </p>
                    </div>
                @endif
            </div>
        </li>
    </a>
    <a href="{{ route('deliveries') }}">
        <li
            class="hover:text-purple-600 relative p-3 lg:mr-8  border-b-2 hover:border-indigo-500 {{ Route::currentRouteName() == 'deliveries' ? $active : $not_active }}">
            My Deliveries

            <div class="absolute bottom-1 right-3 flex items-center">
                <img src="{{ asset('img/delivery_icon.png') }}" alt="" class="w-8">
                @if (App\Http\Controllers\UserController::deliveries_notifications() > 0)
                    <div class=" flex items-center justify-center text-black">
                        <p class="text-sm font-bold">
                            ({{ App\Http\Controllers\UserController::deliveries_notifications() }})</p>
                    </div>
                @endif
            </div>
        </li>
    </a>
</div>
