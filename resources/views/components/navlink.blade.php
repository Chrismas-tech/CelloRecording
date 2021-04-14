@php
/*User*/
$active = 'border-indigo-500';
$not_active = 'border-indigo-200';
/*Admin*/
$active_admin = 'border-green-500';
$not_active_admin = 'border-green-200';
@endphp

<div>
    <ul class="flex text-sm">
        @auth
            <a href="{{ route('dashboard') }}" class="hover:text-purple-600">
                <li
                    class="mq_li_fs relative p-6 md:mr-8 border-b-2 hover:border-b-2 hover:border-indigo-500 {{ Route::currentRouteName() == 'dashboard' ? $active : $not_active }}">
                    Dashboard


                    <div class="absolute bottom-0 right-0 flex items-center">

                        <img src="{{ asset('img/home_icon.png') }}" alt="home icon" class="w-7 mq_icon_size">
                    </div>
                </li>
            </a>
            <a href="{{ route('conversation') }}" class="hover:text-purple-600 hover:border-b-2 hover:border-indigo-500">
                <li
                    class="mq_li_fs relative p-6 md:mr-8  border-b-2 hover:border-indigo-500 {{ Route::currentRouteName() == 'conversation' ? $active : $not_active }}">
                    Conversations

                    <div class="absolute bottom-0 right-0 flex items-center">

                        <img src="{{ asset('img/messages_icon.png') }}" alt="messages icon" class="w-7 mq_icon_size">
                        @if (App\Http\Controllers\UserController::notifications() > 0)
                            <div class="flex items-center justify-center text-black">
                                <p class="text-sm font-bold text-blue-500">
                                    ({{ App\Http\Controllers\UserController::notifications() }})
                                </p>
                            </div>
                        @endif
                    </div>
                </li>
            </a>
            <a href="{{ route('quotes-received') }}"
                class="hover:text-purple-600 hover:border-b-2 hover:border-indigo-500">
                <li
                    class="mq_li_fs relative p-6 md:mr-8  border-b-2 hover:border-indigo-500 {{ Route::currentRouteName() == 'quotes-received' ? $active : $not_active }}">
                    Quotes
                    <div class="absolute bottom-0 right-0 flex items-center">

                        <img src="{{ asset('img/quotes_icon.png') }}" alt="quotes icon" class="w-8 mq_icon_size">
                        @if (App\Http\Controllers\UserController::quotes_notifications() > 0)
                            <div class="flex items-center justify-center text-black">
                                <p class="text-sm font-bold text-blue-500">
                                    ({{ App\Http\Controllers\UserController::quotes_notifications() }})
                                </p>
                            </div>
                        @endif

                    </div>
                </li>
            </a>

            <a href="{{ route('orders') }}" class="hover:text-purple-600">
                <li
                    class="mq_li_fs relative p-6 md:mr-8  border-b-2 hover:border-b-2 hover:border-indigo-500 {{ Route::currentRouteName() == 'orders' ? $active : $not_active }}">
                    Orders

                    <div class="absolute bottom-0 right-0 flex items-center">
                        <img src="{{ asset('img/order_icon.png') }}" alt="orders icon" class="w-7 mq_icon_size">
                        @if (App\Http\Controllers\UserController::order_notifications() > 0)
                            <div class=" flex items-center justify-center text-black ">
                                <p class="text-sm font-bold text-blue-500">
                                    ({{ App\Http\Controllers\UserController::order_notifications() }})
                                </p>
                            </div>
                        @endif
                    </div>
                </li>
            </a>


            <a href="{{ route('deliveries') }}" class="hover:text-purple-600">
                <li
                    class="mq_li_fs relative p-6 lg:mr-8  border-b-2 hover:border-b-2 hover:border-indigo-500 {{ Route::currentRouteName() == 'deliveries' ? $active : $not_active }}">
                    Deliveries

                    <div class="absolute bottom-0 right-0 flex items-center">
                        <img src="{{ asset('img/delivery_icon.png') }}" alt="deliveries icon" class="w-7 mq_icon_size">
                        @if (App\Http\Controllers\UserController::deliveries_notifications() > 0)
                            <div class=" flex items-center justify-center text-black">
                                <p class="text-sm font-bold text-blue-500">
                                    ({{ App\Http\Controllers\UserController::deliveries_notifications() }})</p>
                            </div>
                        @endif
                    </div>
                </li>
            </a>

        @else
            <a href="{{ route('dashboard-admin') }}" class="hover:text-green-600">
                <li
                    class="mq_li_fs relative p-6 md:mr-8  border-b-2 hover:border-b-2 hover:border-green-500 {{ Route::currentRouteName() == 'dashboard-admin' ? $active_admin : $not_active_admin }}">
                    Admin Dashboard
                    <div class="absolute bottom-0 right-0 flex items-center">
                        <img src="{{ asset('img/home_icon.png') }}" alt="home icon" class="w-7 mq_icon_size">
                    </div>
                </li>

            </a>
            <a href="{{ route('list-conversation-admin') }}" class="hover:text-green-600">
                <li
                    class="mq_li_fs relative p-6 md:mr-8  border-b-2 hover:border-green-500  {{ Route::currentRouteName() == 'list-conversation-admin' ? $active_admin : $not_active_admin }}">
                    Conversations with Clients
                    <div class="absolute bottom-0 right-0 flex items-center">
                        <img src="{{ asset('img/messages_icon.png') }}" alt="" class="w-7 mq_icon_size">
                        @if (App\Http\Controllers\AdminController::notifications() > 0)
                            <div class="flex items-center justify-center text-black">
                                <p class="text-sm font-bold text-blue-500">
                                    ({{ App\Http\Controllers\AdminController::notifications() }})
                                </p>
                            </div>
                        @endif
                    </div>
                </li>
            </a>
            <a href="{{ route('quotes-sent') }}" class="hover:text-green-600">
                <li
                    class="mq_li_fs relative p-6 md:mr-8  border-b-2 hover:border-green-500 {{ Route::currentRouteName() == 'quotes-sent' ? $active_admin : $not_active_admin }}">
                    Your Quotes

                    <div class="absolute bottom-0 right-0 flex items-center">
                        <img src="{{ asset('img/quotes_icon.png') }}" alt="" class="w-7 mq_icon_size">
                        @if (App\Http\Controllers\AdminController::quotes_notifications() > 0)
                            <div class="flex items-center justify-center text-black">
                                <p class="text-sm font-bold text-blue-500">
                                    ({{ App\Http\Controllers\AdminController::quotes_notifications() }})</p>
                            </div>
                        @endif
                    </div>
                </li>
            </a>


            <a href="{{ route('orders-admin') }}" class="hover:text-green-600">
                <li
                    class="mq_li_fs relative p-6 md:mr-8  border-b-2 hover:border-b-2 hover:border-green-500 {{ Route::currentRouteName() == 'orders-admin' ? $active_admin : $not_active_admin }}">
                    My Orders

                    <div class="absolute bottom-0 right-0 flex items-center">
                        <img src="{{ asset('img/order_icon.png') }}" alt="" class="w-7 mq_icon_size">
                        @if (App\Http\Controllers\AdminController::order_notifications() > 0)
                            <div class=" flex items-center justify-center text-black">
                                <p class="text-sm font-bold text-blue-500">
                                    ({{ App\Http\Controllers\AdminController::order_notifications() }})
                                </p>
                            </div>
                        @endif
                    </div>
                </li>
            </a>

            <a href="{{ route('admin_logout') }}" class="hover:text-green-600">
                @csrf
                <li class=" relative p-6 md:mr-8 border-green-200 border-b-2 hover:border-b-2 hover:border-green-500">
                    <button type="submit" class="mq_li_fs text-xl focus:outline-none">Logout</button>
                    <div class="absolute bottom-0 right-0 flex items-center">
                        <img src="{{ asset('img/shutdown.png') }}" alt="" class="w-7 mq_icon_size">
                    </div>
                </li>
            </a>
        @endauth
    </ul>
</div>
