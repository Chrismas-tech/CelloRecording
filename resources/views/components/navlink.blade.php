@php
/*User*/
$active ="border-indigo-500";
$not_active ="border-indigo-200";
/*Admin*/
$active_admin ="border-green-500";
$not_active_admin ="border-green-200";
@endphp

<div>
    <ul class="flex text-xl">
        @auth
            <a href="{{ route('dashboard') }}" class="hover:text-purple-600">
                <li
                    class="mq_li_fs relative p-5 md:mr-8 border-b-2 hover:border-b-2 hover:border-indigo-500 {{ Route::currentRouteName() == 'dashboard' ? $active : $not_active }}">
                    Dashboard


                    <div class="absolute bottom-0 right-0 flex items-center">

                        <img src="{{ asset('img/home_icon.png') }}" alt="" class="w-7 mq_icon_size">
                    </div>
                </li>
            </a>
            <a href="{{ route('conversation') }}" class="hover:text-purple-600 hover:border-b-2 hover:border-indigo-500">
                <li
                    class="mq_li_fs relative p-5 md:mr-8  border-b-2 hover:border-indigo-500 {{ Route::currentRouteName() == 'conversation' ? $active : $not_active }}">
                    Conversations

                    <div class="absolute bottom-0 right-0 flex items-center">

                        <img src="{{ asset('img/messages_icon.png') }}" alt="" class="w-7 mq_icon_size">
                        @if (App\Http\Controllers\UserController::notifications() > 0)
                            <div class="flex items-center justify-center text-black">
                                <p class="text-sm font-bold">({{ App\Http\Controllers\UserController::notifications() }})
                                </p>
                            </div>
                        @endif
                    </div>
                </li>
            </a>
            <a href="{{ route('quotes_received') }}" class="hover:text-purple-600 hover:border-b-2 hover:border-indigo-500">
                <li
                    class="mq_li_fs relative p-5 md:mr-8  border-b-2 hover:border-indigo-500 {{ Route::currentRouteName() == 'quotes_received' ? $active : $not_active }}">
                    Your Quotes
                    <div class="absolute flex items-center bottom-1 right-0">

                        <img src="{{ asset('img/quotes_icon.png') }}" alt="" class="w-5 mq_icon_size">
                        @if (App\Http\Controllers\UserController::quotes_notifications() > 0)
                            <div class="flex items-center justify-center text-black">
                                <p class="text-sm font-bold">
                                    ({{ App\Http\Controllers\UserController::quotes_notifications() }})
                                </p>
                            </div>
                        @endif

                    </div>
                </li>
            </a>

            <a href="{{ route('orders') }}" class="hover:text-purple-600">
                <li
                    class="mq_li_fs relative p-5 md:mr-8  border-b-2 hover:border-b-2 hover:border-indigo-500 {{ Route::currentRouteName() == 'orders' ? $active : $not_active }}">
                    My Orders

                    <div class="absolute bottom-0 right-0 flex items-center">
                        <img src="{{ asset('img/order_icon.png') }}" alt="" class="w-7 mq_icon_size">
                        @if (App\Http\Controllers\UserController::order_notifications() > 0)
                            <div class=" flex items-center justify-center text-black ">
                                <p class="text-sm font-bold">
                                    ({{ App\Http\Controllers\UserController::order_notifications() }})
                                </p>
                            </div>
                        @endif
                    </div>
                </li>
            </a>


            <a href="{{ route('deliveries') }}" class="hover:text-purple-600">
                <li
                    class="mq_li_fs relative p-5 lg:mr-8  border-b-2 hover:border-b-2 hover:border-indigo-500 {{ Route::currentRouteName() == 'deliveries' ? $active : $not_active }}">
                    My Deliveries

                    <div class="absolute bottom-0 right-0 flex items-center">
                        <img src="{{ asset('img/delivery_icon.png') }}" alt="" class="w-7 mq_icon_size">
                        @if (App\Http\Controllers\UserController::deliveries_notifications() > 0)
                            <div class=" flex items-center justify-center text-black">
                                <p class="text-sm font-bold">
                                    ({{ App\Http\Controllers\UserController::deliveries_notifications() }})</p>
                            </div>
                        @endif
                    </div>
                </li>
            </a>

        @else
            <a href="{{ route('dashboard_admin') }}" class="hover:text-green-600">
                <li
                    class="mq_li_fs p-5 md:mr-8  border-b-2 hover:border-b-2 hover:border-green-500 {{ Route::currentRouteName() == 'dashboard_admin' ? $active_admin : $not_active_admin }}">
                    Admin Dashboard
                </li>
            </a>
            <a href="{{ route('list_conversation_admin') }}" class="hover:text-green-600">
                <li
                    class="mq_li_fs relative p-5 md:mr-8  border-b-2 hover:border-green-500  {{ Route::currentRouteName() == 'list_conversation_admin' ? $active_admin : $not_active_admin }}">
                    Conversations with Clients
                    <div class="absolute bottom-0 right-0 flex items-center">
                        <img src="{{ asset('img/messages_icon.png') }}" alt="" class="w-7 mq_icon_size">
                        @if (App\Http\Controllers\AdminController::notifications() > 0)
                            <div class="flex items-center justify-center text-black">
                                <p class="text-sm font-bold">({{ App\Http\Controllers\AdminController::notifications() }})
                                </p>
                            </div>
                        @endif
                    </div>
                </li>
            </a>
            <a href="{{ route('quotes_sent') }}" class="hover:text-green-600">
                <li
                    class="mq_li_fs relative p-5 md:mr-8  border-b-2 hover:border-green-500 {{ Route::currentRouteName() == 'quotes_sent' ? $active_admin : $not_active_admin }}">
                    Your Quotes

                    <div class="absolute bottom-1 right-0 flex items-center">
                        <img src="{{ asset('img/quotes_icon.png') }}" alt="" class="w-5 mq_icon_size">
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
                    class="mq_li_fs relative p-5 md:mr-8  border-b-2 hover:border-b-2 hover:border-green-500 {{ Route::currentRouteName() == 'orders_admin' ? $active_admin : $not_active_admin }}">
                    My Orders

                    <div class="absolute bottom-0 right-0 flex items-center">
                        <img src="{{ asset('img/order_icon.png') }}" alt="" class="w-7 mq_icon_size">
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
        @endauth
    </ul>
</div>
