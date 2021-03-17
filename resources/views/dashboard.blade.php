@extends('layouts.app')
@section('content')

    <div class="p-2 md:py-12 md:px-6">

        <div class=" md:pb-12 xl:max-w-7xl xl:mx-auto">
            <div class="flex flex-inline pb-3 md:p-0">
                <a href="/"
                    class="py-2 px-3 text-2xl md:text-4xl dancing_font text-black bg-white border border-gray-300 rounded">
                    Back to the welcome page !
                </a>
            </div>
        </div>

        <div class="mx-auto max-w-7xl">

            <div class="bg-gray-800 p-6 border border-gray-400 rounded">

                <div class="flex flex-inline">
                    <p class="py-2 text-2xl sm:text-3xl md:text-4xl dancing_font text-white bg-red-500 rounded px-2">
                        Welcome to your personal space {{ auth()->user()->name }} !
                    </p>
                </div>
                <div class="flex mt-5 flex-inline">
                    <p class="underline karma text-xs sm:text-sm md:text-lg lg:text-xl text-white baskerville_font rounded">
                        Follow the guide lines below if you want to proceed for a Cello-Recording
                    </p>
                </div>


                <ul class="mt-5">
                    <li class="p-5 border bg-white border-gray-400 rounded">

                        <div>
                            <h1 class="text-3xl dancing_font">Step 1.</h1>
                        </div>

                        <div class="md:flex">

                            <div class="md:w-4/12 p-2 mt-5 mr-10 rounded text-gray-500">
                                <p>Begin a private conversation with me through the <a class="underline text-black"
                                        href="{{ route('conversation') }}">Conversations</a> tab.</p>
                                <br>
                                <p>Describe your cello project, requirements and upload your music files.</p>
                            </div>
                            <div class="md:w-8/12">
                                <img src="{{ asset('img/guide_step_1.jpg') }}" alt=""
                                    class="mt-5 md:mt-0 w-full border border-gray-400 rounded">
                            </div>

                        </div>

                    </li>

                    <li class="p-5 mt-20 border bg-white border-gray-400 rounded">

                        <div>
                            <h1 class="text-3xl dancing_font">Step 2.</h1>
                        </div>

                        <div class="md:flex">

                            <div class="md:w-4/12 p-2 mt-5 mr-10 rounded  text-gray-500">
                                <a class="" href="{{ route('quotes_received') }}">
                                    <p>If you agree about the charge by mutual agreement, you will receive a
                                        quote that you can accept or decline through the tab <a class="underline text-black"
                                            href="{{ route('quotes_received') }}">Your
                                            Quotes</a>.</p>
                                    <br>
                                    <p>Then you can safely proceed to the transfert via Paypal.</p>
                                    <br>
                                    <p>Once your order is created, you will be able to check the status of your
                                        order on through the tab <a class="underline text-black"
                                            href="{{ route('orders') }}">My Orders</a>.</p>
                                </a>
                            </div>
                            <div class="md:w-8/12">
                                <div class="mb-5">
                                    <img src="{{ asset('img/guide_step_2.jpg') }}" alt=""
                                        class="mt-5 md:mt-0 w-full border border-gray-400 rounded">
                                </div>
                                <div>
                                    <img src="{{ asset('img/guide_step_3.jpg') }}" alt=""
                                        class=" w-full border border-gray-400 rounded">
                                </div>

                            </div>
                        </div>
                    </li>

                    <li class="p-5 mt-20 border bg-white border-gray-400 rounded ">

                        <div>
                            <h1 class="text-3xl dancing_font">Step 3.</h1>
                        </div>

                        <div class="md:flex">

                            <div class="md:w-4/12 p-2 mt-5 mr-10 rounded  text-gray-500">
                                <a class="" href="{{ route('conversation') }}">
                                    <p>Once the work is completed, your music files will be available to download on
                                        the section <a class="underline text-black" href="{{ route('deliveries') }}">My
                                            Deliveries</a>.</p>
                                    <br>
                                    <p>Note that you can ask me one free revision if you are not satisfied by the
                                        final result.</p>
                                    <br>
                                    <p>
                                        To avoid this kind of issues, i suggest you to be very precised with the
                                        specifications of your musical project.
                                    </p>
                                </a>
                            </div>
                            <div class="md:w-8/12">
                                <div class="mb-5">
                                    <img src="{{ asset('img/guide_step_4.jpg') }}" alt=""
                                        class="mt-5 md:mt-0 w-full border border-gray-400 rounded">
                                </div>
                                <div>
                                    <img src="{{ asset('img/guide_step_5.jpg') }}" alt=""
                                        class="mt-5 md:mt-0 w-full border border-gray-400 rounded">
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>


            </div>
        </div>
    </div>


@endsection
