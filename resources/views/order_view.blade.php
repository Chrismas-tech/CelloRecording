@extends('layouts.app')
@section('content')

        <div class="pt-12 pb-6">
            <div class="mx-auto max-w-7xl">
                <div>
                    <div class="border-b border-gray-500">
                        <h1 class="text-6xl text-gray-500">Your Delivery !</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="mx-auto max-w-7xl pb-12">

            <div >
                <p class="text-4xl ">Summary of your order #{{ $order->id }}</p>
                <p class="text-sm text-gray-500">Download and listen to the delivery</p>
            </div>

            <div class=" p-8 overflow-hidden sm:rounded-lg bg-gray-700 border rounded">
                <p class="text-3xl mb-3 text-white">Order by {{ $order->user->name }}</p>
                <div>
                    <div class="mb-3">
                        <label for="title" class="px-2 text-white bg-red-400 rounded">Title</label>
                    </div>
                    <div class="mb-6">
                        <input type="text" disabled name="title" class="w-full p-2 border-gray-400 rounded min-h-8 max-h-20"
                            placeholder="Title of the quote" value="{{ $order->title }}">
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
                        <textarea type="text" disabled name="description"
                            class="w-full p-2 border-gray-400 rounded min-h-8 max-h-20">{{ $order->description }}</textarea>
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
                            class="w-full p-2 border-gray-400 rounded min-h-8 max-h-20" disabled
                            value="{{ $order->nb_days }}">
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
                        <input type="number" disabled max="1000" min="1" name="price"
                            class="w-full p-2 border-gray-400 rounded min-h-8 max-h-20" value="{{ $order->price/100 }}">
                        @error('price')
                            <div class="flex flex-row">
                                <p class="mt-1 text-white">{{ $message }}</p>
                            </div>
                        @enderror
                    </div>

                </div>
                <div>
                    <input hidden type="text" name="user_id" value="{{ $order->id }}">
                </div>


                <form action="{{ route('uploadphoto') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label class="text-white text-xl px-4 py-2 bg-gray-800 rounded" for="work">Upload the work</label>
                        <input class="" type="file" id="work" name="work" accept="image/png, image/jpeg">
                    </div>

                    <div class="progress">
                        <div class="progress-bar"></div>
                    </div>
                    
                    <div id="uploadStatus">

                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="focus:outline-none px-4 py-2 text-xl text-white bg-green-500 rounded">Send
                        </button>
                    </div>
                </form>

            </div>
        </div>

@endsection
