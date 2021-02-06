@extends('layouts.app')
@section('content')

    <div class="pt-12 pb-12">

        <div class="mx-auto max-w-7xl">

            <div class="mb-6">

                <div class="border-b border-gray-500">
                    <h1 class="text-6xl text-gray-500">All Deliveries</h1>
                </div>

            </div>

            @if (!$orders_completed->isEmpty())

                @foreach ($orders_completed as $order_completed)
                    <div class="mt-8 mb-3">
                        <p class="text-sm text-gray-500">
                            Delivered on
                            {{ App\Http\Controllers\DateChangeController::date_delivered_on($order_completed->updated_at) }}
                        </p>
                    </div>
                    <div class="mb-8">
                        @if ($order_completed->status == 1)
                            <form action="{{ route('delivery_view', [$order_completed->id])}}"  method="post">
                                @csrf
                                <button type="submit" class="text-white text-xl bg-blue-400 px-2 py-3 rounded">Good news {{ $user_name }}
                                    ! Your
                                    Order #{{ $order_completed->id }} has been

                                    @if ($order_completed->nb_revision == 0)
                                        re-delivered ! Click here and check your files now !
                                    @else
                                        delivered ! Click here and check your files now !
                                    @endif
                                </button>
                            </form>
                        @else
                        <form action="{{ route('delivery_view', [$order_completed->id])}}"  method="post">
                            @csrf
                            <button type="submit" class="text-white text-xl bg-green-400 px-2 py-3 rounded"> Order
                                #{{ $order_completed->id }}
                                completed ! Check your files here !</button>
                            </form>
                        @endif
                    </div>
                @endforeach

            @else
                <div class="mb-10 mt-10 text-center">
                    <p class="text-4xl ">You don't have any delivery for the moment...</p>
                </div>
            @endif




        </div>
    </div>
@endsection
