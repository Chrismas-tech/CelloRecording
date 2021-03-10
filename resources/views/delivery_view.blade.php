@extends('layouts.app')
@section('content')

    <div class="pt-12 pb-12">

        <div class="mx-auto max-w-7xl">

            <div class="mb-6">

                <div class="border-b border-gray-500">
                    <h1 class="text-6xl text-gray-500">Download your files</h1>
                </div>

            </div>

            <div class="mt-10 mb-10">
                <a href="{{ route('deliveries') }}"
                    class="text-3xl bg-gray-800 text-white rounded px-3 py-2 dancing_font">Back to the
                    Delivery list</a>
            </div>

            <div class="p-8 overflow-hidden bg-white border border-gray-300 sm:rounded-lg mt-6 mb-12">

                @if ($order->nb_revision == 0 && $order->status == 4)
                    <div class="bg-yellow-400 rounded w-max">
                        <h1 class="text-4xl text-white px-2 py-2">Your Order #{{ $order->id }} is under revision...
                        </h1>
                    </div>
                @elseif ($order->status == 5)
                    <div class="bg-green-400 rounded w-max">
                        <h1 class="text-4xl text-white px-2 py-2">Order #{{ $order->id }} completed !
                        </h1>
                    </div>
                @elseif ($order->status == 1 && $order->nb_revision == 0)
                    <div>
                        <h1 class="text-4xl underline text-gray-500 px-2 py-2">Your order #{{ $order->id }} has been
                            re-delivered (new
                            files uploaded) !
                        </h1>
                    </div>
                @elseif ($order->status == 1 && $order->nb_revision == 1)
                    <div class="border-b border-gray-500">
                        <h1 class="text-4xl text-gray-500">Your order #{{ $order->id }} has been delivered !
                        </h1>
                    </div>
                @else
                    <div class="border-b border-gray-500">
                        <h1 class="text-4xl text-gray-500">Order #{{ $order->id }}
                        </h1>
                    </div>
                @endif

                @foreach ($deliveries as $delivery)

                    <div class="mt-10">
                        <div>
                            <a href="{{ route('download_delivery_file_user', [$delivery->user_id, $delivery->id, ]) }}"
                                class="py-1 mb-1 flex underline items-center  rounded"><img
                                    src="{{ asset('img/download_icon.png') }}" class="w-7 h-7 mr-3"
                                    alt="">{{ $delivery->file_delivery }}
                            </a>
                        </div>

                        <div class="mt-3">
                            <h1 class="text-2xl text-gray-500">Listen to the track</h1>
                            <audio class="focus:outline-none" controls
                                src="{{ route('audio_delivery_user' , [$delivery->user_id, $delivery->file_delivery]) }}">

                                Your browser does not support the
                                <code>audio</code> element.
                            </audio>
                        </div>
                    </div>
                @endforeach


                @if ($order->status == 1)

                    <div class="border-b border-gray-500 mt-20">
                        <h1 class="text-4xl text-gray-500">Confirm the order</h1>
                    </div>

                    <div class="flex justify-between">

                        <div class="mt-10">
                            <form action="{{ route('update_delivery') }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <div class="max-w-4xl ">
                                    @if ($order->nb_revision == 1)
                                        <div class="flex items-center bg-red-400 px-3 py-4 rounded text-white">
                                            <div>
                                                <input type="radio" name="order_status" value="4">
                                                <label class="ml-5" for="order_status">Ask a revision</label>
                                                <p class="text-black underline mt-1">Note : you can ask only one more
                                                    revision
                                                    for free,
                                                    write me a
                                                    message for more informations</p>
                                            </div>
                                        </div>
                                    @endif

                                    <div
                                        class="bg-gray-800 px-3 py-4 rounded {{ $order->nb_revision == 1 ? 'mt-10' : '' }} text-white w-max">
                                        <div class="flex items-center ">
                                            <input type="radio" name="order_status" value="5"checked>
                                            <label class="ml-5" for="order_status" >Mark the order as completed !</label>
                                        </div>
                                    </div>

                                    @error('order_status')
                                        <div class="text-gray-800 text-xl mt-3">{{ $message }}
                                        </div>
                                    @enderror


                                    <div class="mt-10 flex justify-end">
                                        <button type="submit"
                                            class="px-2 rounded py-3 text-xl text-white bg-green-400">Confirm</button>
                                    </div>

                                </div>

                            </form>
                        </div>

                    </div>

                    <!-- Si la commande est confirmée par le client -->
                    <!-- Si la commande est confirmée par le client -->
                    <!-- Si la commande est confirmée par le client -->

                @elseif ($order->status == 5)

                @endif

            </div>


        </div>

    </div>
@endsection
