@extends('layouts.app')
@section('content')

    <div class="p-5 sm:p-12">

        <div class="mx-auto max-w-7xl">

            <div class="border-b border-gray-500">
                <h1 class="text-2xl sm:text-3xl md:text-6xl text-gray-500">My Custom Offer(s)</h1>
            </div>

            @if (!$quotes->isEmpty())

                @if (Session::has('message'))
                    <div class="mt-5 mb-5 text-center">
                        <p class="px-2 py-3 text-white bg-green-400 rounded ">{{ Session::get('message') }}</p>
                    </div>
                @endif

                @foreach ($quotes as $quote)

                    <div class="p-4 sm:p-8 overflow-hidden bg-white border rounded max-w-5xl mx-auto border-gray-300 mt-3 mb-3 sm:mt-6 sm:mb-6 md:mt-12 md:mb-12 ">

                        <p class="text-lg sm:text-2xl md:text-3xl courgette_font">Accept or decline this offer : Quote #{{ $quote->id }}</p>


                        <div class="p-5 mt-5 bg-gray-700 border rounded">

                            <form action="{{ route('send_quote_client') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="title" class="text-xs sm:text-md md:text-lg px-2 text-white bg-red-400 rounded">Title</label>
                                </div>
                                <div class="mb-6">
                                    <input type="text" name="title"
                                        class="text-xs sm:text-md md:text-lg w-full p-2 border-gray-400 rounded min-h-8 max-h-20" disabled
                                        placeholder="Title of the quote" value="{{ $quote->title }}">
                                    @error('title')
                                        <div class="flex flex-row">
                                            <p class="mt-1 text-white">{{ $message }}</p>
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="text-xs sm:text-md md:text-lg px-2 text-white bg-red-400 rounded">Description</label>
                                </div>
                                <div class="mb-6">
                                    <textarea type="text" name="description" disabled
                                        class="text-xs sm:text-md md:text-lg w-full p-2 border-gray-400 rounded min-h-8 max-h-32">{{ $quote->description }}</textarea>
                                    @error('description')
                                        <div class="flex flex-row">
                                            <p class="text-white ">{{ $message }}</p>
                                        </div>
                                    @enderror
                                </div>


                                <div class="mb-3">
                                    <label for="days" class="text-xs sm:text-md md:text-lg px-2 text-white bg-red-400 rounded">Days to complete the
                                        work</label>
                                </div>
                                <div class="mb-6">
                                    <input type="number" max="14" min="1" name="nb_days" disabled
                                        class="text-xs sm:text-md md:text-lg w-full p-2 border-gray-400 rounded min-h-8 max-h-20"
                                        value="{{ $quote->nb_days }}">
                                    @error('nb_days')
                                        <div class="flex flex-row">
                                            <p class="mt-1 text-white">{{ $message }}</p>
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="price" class="text-xs sm:text-md md:text-lg px-2 text-white bg-red-400 rounded">Price in €</label>
                                </div>
                                <div class="mb-6">
                                    <input type="number" max="14" min="1" name="price" disabled
                                        class="text-xs sm:text-md md:text-lg w-full p-2 border-gray-400 rounded min-h-8 max-h-20"
                                        value="{{ $quote->price / 100 }}">
                                    @error('price')
                                        <div class="flex flex-row">
                                            <p class="mt-1 text-white">{{ $message }}</p>
                                        </div>
                                    @enderror
                                </div>


                                <div>
                                    <input hidden type="text" name="quote_id" value="{{ $quote->id }}">
                                    <input hidden type="text" name="user_id" value="{{ Auth()->user()->id }}">
                                </div>
                            </form>

                            <div class="flex items-center justify-end">

                                <div>
                                    <form action="{{ route('page_paypal_payment', ['quote_id' => $quote->id, $quote->price]) }}" method="post">
                                        @csrf   
                                        <button type="submit"
                                        class="text-xs sm:text-md md:text-lg px-4 py-2 mr-5 text-white bg-green-500 rounded">Accept
                                    </button>
                                    </form>
                                </div>
                                
                                <div>
                                    <form action="{{ route('quotes_decline', ['quote_id' => $quote->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-xs sm:text-md md:text-xl px-4 py-2 mr-5 text-white bg-red-500 rounded">Decline
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
        </div>
    @else
        <div class="mb-10 mt-10 text-center">
            <p class="text-4xl ">You don't have any custom offer for the moment...</p>
        </div>
        @endif
    @endsection
