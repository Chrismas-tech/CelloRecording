@extends('layouts.app')
@section('content')

    <div class="flex flex-col justify-around my_min_height">

        <div class="mx-auto lg:max-w-7xl p-5 mq_order_payment_width">

            <div class="text-center text-white bg-gray-800 rounded-t ">
                <h1 class="mq_font_size_Order_payment_text py-4 text-5xl courgette_font mq_title_order_payment_page">Order
                    Payment page</h1>
            </div>

            <div class="bg-white border-2 border-t-0 border-gray-300 rounded-b ">


                <!-- IMG + DESCRIPTION -->
                <!-- IMG + DESCRIPTION -->
                <!-- IMG + DESCRIPTION -->
                <!-- IMG + DESCRIPTION -->
                <!-- IMG + DESCRIPTION -->
                <!-- IMG + DESCRIPTION -->
                <!-- IMG + DESCRIPTION -->

                <div class="p-5 lg:flex text-xl">
                    <div class="mr-8 lg:w-4/12 mq_img_div_center">
                        <img src="{{ asset('img/bg_cello_paypal.png') }}" alt="img_cello"
                            class="img_cello_payment object-fill border-4  border-gray-400 rounded shadow-xl">
                    </div>
                    <div class="w-8/12 mq_titlePCR_plus_description">
                        <h1
                            class="mq_payment_page_font_size_titles px-2 py-2 text-2xl text-white bg-blue-400 rounded karma">
                            Professional Cello Recording
                        </h1>
                        <div class="bg-gray-100 border-gray-400 border p-3 rounded mt-3">
                            <p
                                class="mq_payment_page_font_size_titles karma bg-red-400 mb-3 text-white px-2 py-2 rounded">
                                Recording
                                for
                                {{ $quote->user->name }} <br> Description of the work
                            </p>

                            <p class="text-md mq_payment_page_font_size_description"> {{ $quote->description }}
                            </p>
                        </div>
                    </div>


                    <!-- PRICE DETAILS -->
                    <!-- PRICE DETAILS -->
                    <!-- PRICE DETAILS -->
                    <!-- PRICE DETAILS -->
                    <!-- PRICE DETAILS -->

                    <div class="text-xl ml-8 flex flex-col justify-between mq_price_details_block">

                        <div class="px-2 py-2 mb-8 text-white bg-blue-600 rounded courgette_font">
                            <h1 class="mq_payment_page_font_size_titles text-2xl ">
                                Price Details
                            </h1>
                        </div>

                        <div class="mq_text_price bg-gray-100 w-max rounded p-2 border border-gray-400">
                            <p>Product : (1 Cello Recording)</p>
                            <p>Delivery : {{ $quote->nb_days }} days</p>
                        </div>

                        <div class="mt-5 mb-5 border-b border-gray-800">
                        </div>

                        <div class="flex justify-end">
                            <div>
                                <p>Total via Paypal : <span
                                        class="px-2 py-2 mb-3 text-white bg-red-400 rounded">{{ $quote->price / 100 }}
                                        €</span>
                                </p>
                            </div>
                        </div>


                        <div class="container mt-5 flex justify-end items-center">

                        <div>
                            <a href="{{ route('create_order_paypal') }}" class="flex items-center">
                                <img src="{{asset('img/paypal-logo.png')}}" alt="" class="w-36 border-2 border-blue-400 hover:border-blue-700 rounded px-2 py-3 shadow-lg"></a>
                        </div>

                        <div>
                            <input hidden id="price" type="number" value="{{ $quote->price / 100 }}">
                            @csrf
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
