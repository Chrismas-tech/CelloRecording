@extends('layouts.app')
@section('content')

    <div class="flex flex-col justify-around my_min_height">
        <div class="mx-auto w-7/12">
            <div class="text-center text-white  bg-gray-800  rounded-t">
                <h1 class="py-4 text-5xl courgette_font">Order Payment page</h1>
            </div>

            <div class="bg-white border-2 border-gray-300 rounded-b">

                <div class="flex justify-between p-5 ">
                    <div class="flex text-xl ">
                        <div>
                            <img src="{{ asset('img/cello_payment.jpg') }}" alt=""
                                class="h-auto mr-3 rounded shadow-md w-52">
                        </div>
                        <div>
                            <div>
                                <h1 class="inline-flex px-2 py-2 text-2xl text-white bg-indigo-400 rounded courgette_font">
                                    Professional Cello
                                    Recording</h1>
                            </div>
                            <div class="mt-8">
                                <h1>Title : {{ $quote->title }}</h1>
                                <h1>Description : {{ $quote->description }}</h1>
                                <h1>User : {{ $quote->user->name }}</h1>
                            </div>
                        </div>
                    </div>

                    <div class="text-xl">

                        <div class="inline-flex px-2 py-2 mb-8 text-white bg-indigo-400 rounded courgette_font">
                            <h1 class="text-2xl">
                                Price Details
                            </h1>
                        </div>

                        <div>
                            <p>Product : (1 Cello Recording)</p>
                            <p>Delivery : {{ $quote->nb_days }} days</p>
                        </div>

                        <div class="mt-5 mb-5 border-b border-gray-800">

                        </div>

                        <div class="flex">
                            <div>
                                <p>Total : <span
                                        class="px-2 py-2 mb-3 text-white bg-red-400 rounded">{{ $quote->price / 100 }}
                                        €</span>
                                </p>
                            </div>
                        </div>

                        <div id="paypal_button" class="mt-5">
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


    <script src="https://www.paypalobjects.com/api/checkout.js">
    </script>

    <script src={{ asset('js/payment_paypal.js') }}>
    </script>
@endsection
