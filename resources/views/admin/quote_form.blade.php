@extends('layouts.app')
@section('content')

    <div class="flex mx-auto max-w-7xl sm:px-6 lg:px-8 pt-12 pb-12">

        <div class="w-4/12 mr-10">
            <p class="text-4xl ">My Custom Offer </p>
            <p class="text-sm text-gray-500">Send a custom offer to the Client</p>
        </div>
        <div class="w-8/12 p-8 overflow-hidden bg-white border border-gray-300 sm:rounded-lg">

            <p class="text-3xl ">My Custom Quote for {{ $user_name }}</p>

            <form action="{{ route('send_quote_client') }}" method="post" class="p-5 mt-5 bg-gray-700 border rounded">
                @csrf
                <div>
                    <div class="mb-3">
                        <label for="title" class="px-2 text-white bg-red-400 rounded">Title</label>
                    </div>
                    <div class="mb-6">
                        <input type="text" name="title" class="w-full p-2 border-gray-400 rounded min-h-8 max-h-20"
                            placeholder="Title of the quote" value="Professionnal Cello Recording">
                        @error('title')
                            <div class="flex flex-row">
                                <p class="mt-1 text-white">{{ $message }}</p>
                            </div>
                        @enderror
                    </div>

                </div>

                <div>
                    <div class="mb-3">
                        <label for="description" class="px-2 text-white bg-red-400 rounded">Description</label>
                    </div>
                    <div class="mb-6">
                        <textarea type="text" name="description" class="w-full p-2 border-gray-400 rounded min-h-8 max-h-20"
                            placeholder="Write a description here..."></textarea>
                        @error('description')
                            <div class="flex flex-row">
                                <p class="text-white ">{{ $message }}</p>
                            </div>
                        @enderror
                    </div>

                </div>
                <div>
                    <div class="mb-3">
                        <label for="days" class="px-2 text-white bg-red-400 rounded">Days to complete the work</label>
                    </div>
                    <div class="mb-6">
                        <input type="number" max="14" min="1" name="nb_days"
                            class="w-full p-2 border-gray-400 rounded min-h-8 max-h-20"
                            placeholder="Number of days required to deliver the recording">
                        @error('nb_days')
                            <div class="flex flex-row">
                                <p class="mt-1 text-white">{{ $message }}</p>
                            </div>
                        @enderror
                    </div>


                </div>
                <div>
                    <div class="mb-3">
                        <label for="price" class="px-2 text-white bg-red-400 rounded">Price in €</label>
                    </div>
                    <div class="mb-6">
                        <input type="number" max="1000" min="1" name="price"
                            class="w-full p-2 border-gray-400 rounded min-h-8 max-h-20" placeholder="Choose a price">
                        @error('price')
                            <div class="flex flex-row">
                                <p class="mt-1 text-white">{{ $message }}</p>
                            </div>
                        @enderror
                    </div>

                </div>
                <div>
                    <input hidden type="text" name="user_id" value="{{ $user_id }}">
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 mr-5 text-xl text-white bg-green-500 rounded">Send</button>
                </div>
            </form>
        </div>
    </div>
@endsection
