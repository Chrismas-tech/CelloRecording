@extends('layouts.app')
@section('content')

    <div class="pt-12 pb-12">
        <div class="container max-w-5xl mx-auto">
            @if (!$quotes->isEmpty())
            <div class="mb-10 mr-10">
                <p class="mb-5 text-4xl">You sent already {{ App\Http\Controllers\AdminController::quotes_notifications() }} quotes</p>
            </div>
                @foreach ($quotes as $quote)
                    <div class="p-8 overflow-hidden bg-white border rounded max-w-5xl mx-auto border-gray-300 mt-12 mb-12">
                        <div class="mb-10 mr-10">
                            <p class="mb-5 text-4xl">Quote #{{ $quote->id }} - pending</p>
                            <p class="text-3xl dancing_font">Sent to Client #{{ $quote->user->name }}</p>
                        </div>
                        <div class="p-8 mb-10 overflow-hidden text-black bg-gray-700 border border-gray-300 sm:rounded-lg">

                            <div>
                                <div class="mb-3">
                                    <label for="title" class="px-2 text-white bg-red-400 rounded">Title</label>
                                </div>
                                <div class="mb-6">
                                    <input type="text" name="title"
                                        class="w-full p-2 border-gray-400 rounded min-h-8 max-h-20" disabled
                                        placeholder="Title of the quote" value="{{ $quote->title }}">
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
                                    <input type="text" name="description" disabled
                                        class="w-full p-2 border-gray-400 rounded min-h-8 max-h-20"
                                        value="{{ $quote->description }}"></input>
                                </div>
                            </div>
                            <div>
                                <div class="mb-3">
                                    <label for="days" class="px-2 text-white bg-red-400 rounded">Days to complete the
                                        work</label>
                                </div>
                                <div class="mb-6">
                                    <input type="number" name="nb_days" disabled
                                        class="w-full p-2 border-gray-400 rounded min-h-8 max-h-20"
                                        value="{{ $quote->nb_days }}">
                                </div>
                            </div>
                            <div>
                                <div class="mb-3">
                                    <label for="price" class="px-2 text-white bg-red-400 rounded">Price in €</label>
                                </div>
                                <div class="mb-6">
                                    <input type="number" name="price" disabled
                                        class="w-full p-2 border-gray-400 rounded min-h-8 max-h-20"
                                        value="{{ $quote->price / 100 }}">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="mb-10 mt-10 text-center">
                    <p class="text-4xl ">You didn't sent any custom offer for the moment...</p>
                </div>
            @endif
        </div>

    </div>
@endsection
