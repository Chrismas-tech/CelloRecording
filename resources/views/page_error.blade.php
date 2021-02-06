@extends('layouts.app')
@section('content')

    <div class="flex flex-col justify-around my_min_height">

        <div class="mx-auto max-w-7xl">

            <div class="text-center">
                <h1 class="text-6xl text-gray-500">Page not found !</h1>
                <h1 class="text-2xl text-gray-500 mt-5">Something went wrong...</h1>
            </div>

            <div class="text-center">
                @if (Session::has('message'))
                    <h1 class="text-6xl text-gray-500">{{ Session::get('message') }}</h1>
                @endif
            </div>

        </div>
    </div>

@endsection
