@extends('layouts.app')
@section('content')

    @php
    $table_header = "bg-gray-700 text-white border border-gray-500 p-3 text-sm md:text-xl";
    @endphp

    

    <div class="p-8 md:p-12">

        <div class="mx-auto max-w-7xl">

            <div class="mb-6">

                <div class="border-b border-gray-500">
                    <h1 class="text-2xl sm:text-3xl md:text-6xl text-gray-500">Manage your orders</h1>
                </div>

                @if (!$orders->isEmpty())

                    <div class="bg-white rounded p-4 mt-8 max-w-2xl md:max-w-xl border border-gray-300 text-md md:text-xl">

                        <div>
                            <h1 class="underline text-lg text-gray-500">Possible status</h1>
                        </div>

                        <div class="flex justify-around md:justify-between">
                            <div class="mr-8 border-gray-400 md:border-r">
                                <div class="mt-3 mr-5 flex items-center">
                                    <div class="bg-blue-400 mr-5 rounded-full w-4 h-4">
                                    </div>
                                    <div>
                                        <p class=" text-blue-400">
                                            delivered</p>
                                    </div>
                                </div>
                                <div class="mt-3 mr-5 flex items-center">
                                    <div class=" bg-green-500 mr-5 rounded-full w-4 h-4">
                                    </div>
                                    <div>
                                        <p class="text-green-500">
                                            completed</p>
                                    </div>
                                </div>
                                <div class="mt-3 mr-5 flex items-center">
                                    <div class="bg-red-400 mr-5 rounded-full w-4 h-4">
                                    </div>
                                    <div>
                                        <p class="text-red-400">
                                            waiting
                                            to be completed</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="mt-3 mr-5 flex items-center">
                                    <div class=" bg-yellow-400 mr-5 rounded-full w-4 h-4">
                                    </div>
                                    <div>
                                        <p class=" text-yellow-500">
                                            revision</p>
                                    </div>
                                </div>
                                <div class="mt-3 mr-5 flex items-center">
                                    <div class=" bg-gray-400 mr-5 rounded-full w-4 h-4">
                                    </div>
                                    <div>
                                        <p class="text-gray-400">
                                            canceled</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

            <div id="orders_desktop_resp"
                class="p-3 md:p-5 lg:p-8 overflow-hidden bg-white border border-gray-300 sm:rounded-lg mt-6 mb-12">

                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="{{ $table_header }}">Order</th>
                            <th class="{{ $table_header }}">Status</th>
                            <th class="{{ $table_header }}">Due on</th>
                            <th class="{{ $table_header }}">Total</th>
                            <th class="{{ $table_header }}">Delivery</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($orders as $order)

                            @php
                            $text;
                            $class ="border-gray-500";

                            if($order->status == 3) {

                            $text="waiting";
                            $bg_status ="bg-red-400";

                            }elseif($order->status == 2) {

                            $text="canceled";
                            $bg_status ="bg-gray-400";

                            } elseif($order->status == 1) {

                            if($order->nb_revision == 1) {
                            $text="delivered";
                            $bg_status ="bg-blue-400";
                            } else {
                            $text="re-delivered";
                            $bg_status ="bg-blue-400";
                            }


                            } elseif($order->status == 4) {

                            $text="revision";
                            $bg_status ="bg-yellow-500";
                            } elseif($order->status == 5) {

                            $text="completed";
                            $bg_status ="bg-green-400";
                            }

                            @endphp

                            <tr>
                                <td
                                    class="{{ $class }} bg-white border p-2 md:p-4 courgette_font align-middle text-center text-sm md:text-xl underline">
                                    <p>#{{ $order->id }}</p>
                                </td>


                                <td
                                    class="{{ $class }} bg-white border p-2 md:p-3  align-middle text-center text-sm md:text-md lg:text-xl">
                                    <p class="{{ $bg_status }} px-2 text-white rounded">{{ $text }}</p>
                                </td>

                                <td
                                    class="{{ $class }} bg-white border p-4 courgette_font align-middle text-center text-sm md:text-md lg:text-xl">
                                    {{ App\Http\Controllers\DatechangeController::date_due_on_buyer($order->created_at, $order->nb_days) }}
                                </td>

                                <td
                                    class="{{ $class }} bg-white border p-4 align-middle text-center text-sm md:text-md lg:text-xl">
                                    {{ $order->price / 100 }}€
                                </td>

                                <td
                                    class="{{ $class }} bg-white border p-4 align-middle text-center text-sm md:text-md lg:text-xl">

                                    @if ($order->status == 1)
                                        <form action="{{ route('delivery_view', [$order->id]) }}" method="post">
                                            @csrf
                                            <button class="underline">Check
                                                your delivery now !
                                            </button>
                                        </form>
                                    @elseif ($order->status == 2)
                                        <p>Canceled</p>
                                    @elseif ($order->status == 3)
                                        <p>Cello Recording in process...</p>
                                    @elseif ($order->status == 4)
                                        <form action="{{ route('delivery_view', [$order->id]) }}" method="post">
                                            @csrf
                                            <button class="underline">Revision in
                                                Process
                                            </button>
                                        </form>
                                    @elseif ($order->status == 5)
                                        <form action="{{ route('delivery_view', [$order->id]) }}" method="post">
                                            @csrf
                                            <button class="underline">Order marked as
                                                completed
                                            </button>
                                        </form>
                                    @endif

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @foreach ($orders as $order)

            @php
            $text;
            $class ="border-gray-500";

            if($order->status == 3) {

            $text="waiting";
            $bg_status ="bg-red-400";

            }elseif($order->status == 2) {

            $text="canceled";
            $bg_status ="bg-gray-400";

            } elseif($order->status == 1) {

            if($order->nb_revision == 1) {
            $text="delivered";
            $bg_status ="bg-blue-400";
            } else {
            $text="re-delivered";
            $bg_status ="bg-blue-400";
            }


            } elseif($order->status == 4) {

            $text="revision";
            $bg_status ="bg-yellow-500";
            } elseif($order->status == 5) {

            $text="completed";
            $bg_status ="bg-green-400";
            }

            @endphp

            
                <div id="orders_phone_resp" class="p-5 mb-10  bg-white rounded  border-gray-300 border w-max mx-auto">
                    <div class="flex">
                        <p class="bg-white courgette_font text-3xl underline mr-5">
                            Order #{{ $order->id }}
                        </p>
                        <p class="bg-white text-3xl">
                        <p class="{{ $bg_status }} px-2 text-white text-2xl rounded">Status : {{ $text }}</p>
                        </p>
                    </div>
                    <div class="flex">

                    </div>
                    <div class="flex mt-5">
                        <p class="bg-white courgette_font text-xl">
                            Due on
                            {{ App\Http\Controllers\DatechangeController::date_due_on_buyer($order->created_at, $order->nb_days) }}
                        </p>
                    </div>
                    <div class="flex">
                        <p class="bg-white text-xl">
                            Total : {{ $order->price / 100 }}€
                        </p>

                    </div>
                    <div class="flex text-xl mt-3 justify-center">
                        @if ($order->status == 1)
                            <form action="{{ route('delivery_view', [$order->id]) }}" method="post">
                                @csrf
                                <button class="underline">Check
                                    your delivery now !
                                </button>
                            </form>
                        @elseif ($order->status == 2)
                            <p> Canceled</p>
                        @elseif ($order->status == 3)
                            <p> Cello Recording in process...</p>
                        @elseif ($order->status == 4)
                            <form action="{{ route('delivery_view', [$order->id]) }}" method="post">
                                @csrf
                                <button class="underline"> Revision in
                                    Process
                                </button>
                            </form>
                        @elseif ($order->status == 5)
                            <form action="{{ route('delivery_view', [$order->id]) }}" method="post">
                                @csrf
                                <button class="underline"> Order marked as
                                    completed
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach

        @else
            <div class="mb-10 mt-10  text-center">
                <p class="text-4xl ">You don't have any order for the moment...</p>
            </div>
            @endif

        </div>
    </div>
@endsection
