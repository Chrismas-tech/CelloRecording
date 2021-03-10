@extends('layouts.app')
@section('content')

    <div class="flex flex-col justify-around my_min_height">
        <div class="max-w-5xl mx-auto text-center">
            <div>
                <h1 class="text-5xl text-gray-500">Payment Successfull !</h1>
                <h1 class="text-5xl text-gray-500 mt-3">You will be redirected to the order page in a few seconds...</h1>
            </div>
            <div class="flex justify-center">
                <img src="{{ asset('img/checked.png') }}" alt="" class="w-28 h-28 text-center">
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            setTimeout(() => {
                window.location.replace('http://cellorecording-local.test/orders');
            }, 4000);
        })
    </script>
@endsection
