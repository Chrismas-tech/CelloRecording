@extends('layouts.app')
@section('content')

    @if (!$orders->isEmpty())
        @php
        $table_header = "bg-gray-700 text-white border border-gray-500 p-3 text-xl";
        @endphp

        <div class="pt-12 pb-12">

            <div class="mx-auto max-w-7xl">

                <div class="mb-6">

                    <div class="border-b border-gray-500">
                        <h1 class="text-6xl text-gray-500">Manage Orders</h1>
                    </div>

                </div>

                <div class="p-8 overflow-hidden bg-white border border-gray-300 sm:rounded-lg mt-6 mb-12">

                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="{{ $table_header }}">Order</th>
                                <th class="{{ $table_header }}">Buyer</th>
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

                                if($order->nb_revision== 1) {
                                $text="delivered";
                                $bg_status ="bg-blue-400";
                                } else {
                                $text="re-delivered";
                                $bg_status ="bg-blue-400";
                                }


                                } elseif($order->status == 4) {

                                $text="revision";
                                $bg_status ="bg-yellow-400";
                                } elseif($order->status == 5) {

                                $text="completed";
                                $bg_status ="bg-green-400";
                                }

                                @endphp

                                <tr>
                                    <td
                                        class="{{ $class }} bg-white border p-4 courgette_font align-middle text-center text-xl underline">
                                        <a
                                            href="{{ route('order_view_admin', ['order_id' => $order->id]) }}">#{{ $order->id }}</a>
                                    </td>

                                    <td class="{{ $class }} bg-white border  p-4  align-middle text-center text-xl">
                                        <p>{{ $order->user->name }}</p>
                                    </td>


                                    <td class="{{ $class }} bg-white border  p-4  align-middle text-center text-xl">
                                        <p class="{{ $bg_status }} px-2 text-white rounded">{{ $text }}</p>
                                    </td>

                                    <td
                                        class="{{ $class }} bg-white border p-4 courgette_font align-middle text-center text-xl">
                                        {{ App\Http\Controllers\DatechangeController::date_due_on_buyer($order->created_at, $order->nb_days) }}
                                    </td>

                                    <td class="{{ $class }} bg-white border p-4 align-middle text-center text-xl">
                                        {{ $order->price / 100 }}€
                                    </td>

                                    <td class="{{ $class }} bg-white border p-4 align-middle text-center text-xl">

                                        @if ($order->status == 1)
                                            <a href="{{ route('order_view_admin', ['order_id' => $order->id]) }}"
                                                class="underline">Already delivered !</a>
                                        @elseif ($order->status == 2)
                                            <p>Canceled</p>
                                        @elseif ($order->status == 3)
                                            <a href="{{ route('order_view_admin', ['order_id' => $order->id]) }}"
                                                class="underline">Deliver now</a>
                                        @elseif ($order->status == 4)
                                            <a href="{{ route('order_view_admin', ['order_id' => $order->id]) }}"
                                                class="underline">Deliver the work again</a>
                                        @elseif ($order->status == 5)
                                            <a href="{{ route('order_view_admin', ['order_id' => $order->id]) }}"
                                                class="underline">Order marked as completed !</a>
                                        @endif

                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <div class="pt-12 pb-12">
            <div class="mb-10 mt-10 text-center">
                <p class="text-4xl ">You don't have any order to complete for the moment...</p>
            </div>
        </div>
    @endif
@endsection
