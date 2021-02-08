@php
/*Admin*/
$active_admin ="border-green-500 bg-green-100 font-bold text-green-600";
$not_active_admin ="border-green-200";
@endphp

<div class="list-none">

    <a href="{{ route('dashboard_admin') }}" class="hover:text-green-600">
        <li
            class="relative p-5  border-b-2 hover:border-green-500 {{ Route::currentRouteName() == 'dashboard_admin' ? $active_admin : $not_active_admin }}">
            Admin Dashboard
            <div class="absolute bottom-3 right-3">
                <img src="{{ asset('img/profile.png') }}" alt="" class="w-12">
            </div>
        </li>
    </a>
    <a href="{{ route('list_conversation_admin') }}" class="hover:text-green-600">
        <li
            class="relative p-5  border-b-2 hover:border-green-500  {{ Route::currentRouteName() == 'list_conversation_admin' ? $active_admin : $not_active_admin }}">
            Conversations with Clients
            <div class="absolute bottom-3 right-3 flex items-center">
                <img src="{{ asset('img/messages_icon.png') }}" alt="" class="w-12">
                @if (App\Http\Controllers\AdminController::notifications() > 0)
                    <div class="flex items-center justify-center text-black">
                        <p class="text-sm font-bold">
                            ({{ App\Http\Controllers\AdminController::notifications() }})</p>
                    </div>
                @endif
            </div>
        </li>
    </a>
    <a href="{{ route('quotes_sent') }}" class="hover:text-green-600">
        <li
            class="relative p-5  border-b-2 hover:border-green-500 {{ Route::currentRouteName() == 'quotes_sent' ? $active_admin : $not_active_admin }}">
            Your Quotes

            <div class="absolute bottom-3 right-3">
                <img src="{{ asset('img/quotes_icon.png') }}" alt="" class="w-10">
                @if (App\Http\Controllers\AdminController::quotes_notifications() > 0)
                    <div class="flex items-center justify-center text-black">
                        <p class="text-sm font-bold">
                            ({{ App\Http\Controllers\AdminController::quotes_notifications() }})</p>
                    </div>
                @endif
            </div>
        </li>
    </a>

    <a href="{{ route('orders_admin') }}" class="hover:text-purple-600">
        <li
            class="relative p-5  border-b-2 hover:border-green-500 {{ Route::currentRouteName() == 'orders_admin' ? $active_admin : $not_active_admin }}">
            My Orders

            <div class="absolute bottom-3 right-3 flex items-center">
                <img src="{{ asset('img/order_icon.png') }}" alt="" class="w-12">
                @if (App\Http\Controllers\AdminController::order_notifications() > 0)
                    <div class=" flex items-center justify-center text-black">
                        <p class="text-sm font-bold">
                            ({{ App\Http\Controllers\AdminController::order_notifications() }})
                        </p>
                    </div>
                @endif
            </div>
        </li>
    </a>
    <a href="{{ route('admin_logout') }}" class="hover:text-green-600">
        @csrf
        <li
            class=" relative p-5 md:mr-8 border-green-200 border-b-2 hover:border-b-2 hover:border-green-500">
            <button type="submit" class=" focus:outline-none">Logout</button>
            <div class="absolute bottom-3 right-3 flex items-center">
                <img src="{{ asset('img/shutdown.png') }}" alt="" class="w-12">

            </div>
        </li>
    </a>
</div>
