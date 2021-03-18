@extends('layouts.app')
@section('content')
    <div class="p-16">
        <div class="flex h-44">

            <div class="w-3/12 mr-10">

                <div class="mx-auto bg-white border border-gray-200 rounded max-w-7xl">
                    <div class="flex p-3 bg-blue-900 text-white">
                        <p class=" mr-8 text-2xl courgette_font underline">All current Conversations
                        </p>
                    </div>

                    <div>

                        @foreach ($nb_users as $user)
                            <div>

                                <a class="p-3 flex justify-between overflow-hidden text-xl text-black karma bg-blue-400 w-full hover:bg-blue-500 border-gray-300 border-b border-r border-l"
                                    href="{{ route('conversation_with_user', ['user_id' => $user->id]) }}">

                                    <div>
                                        Talk with <span class="text-white"> {{ $user->name }} </span> now !
                                    </div>
       
                                </a>

                            </div>
                        @endforeach


                    </div>
                </div>
            </div>


            <div class="w-9/12">
                @if ($nb_notifications)
                    <div class="mx-auto bg-white border border-gray-200 rounded p-7 max-w-7xl">
                        <div class="flex item-center">
                            <div>
                                <h1 class="mb-5 mr-3 text-3xl courgette_font">List of new
                                    messages
                                </h1>
                            </div>

                            <div id="unread_messages"
                                class="px-3 py-1 mb-5 mr-10 text-sm text-white bg-red-400 rounded top-3 left-3 courgette_font">

                                @if ($nb_notifications == 1)
                                    <div class="text-xl">
                                        <h1>1 message unseen</h1>
                                    </div>

                                @elseif($nb_notifications > 1)
                                    <div class="text-xl">
                                        <h1>{{ $nb_notifications }} messages unseen</h1>
                                    </div>
                                @endif
                            </div>
                        </div>
                @else 
                <div class="mx-auto bg-white border border-gray-200 rounded p-7 max-w-7xl">
                    <div class="flex item-center">
                        <div>
                            <h1 class=" mr-3 text-3xl courgette_font">No new messages for the moment...
                            </h1>
                        </div>
                    </div>
                </div>
                @endif

                @foreach ($notifs_all_user as $notif)
                    <div class="mx-auto mt-3 max-w-7xl">
                        <div class="text-sm text-gray-500">
                            {{ App\Http\Controllers\DateChangeController::date_created_at_to_string($notif->created_at) }}
                        </div>

                        <div class="inline-flex px-4 py-3 overflow-hidden text-white bg-green-400 shadow-sm sm:rounded-lg">

                            <div>
                                <a href="{{ route('conversation_with_user', ['user_id' => $notif->user_id]) }}"><span
                                        class="font-bold text-gray-500">{{ $notif->user->name }}</span>
                                    sent you a new message ! Click here and read it now ! <div>
                                    </div></a>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>






    <script>
        $(document).ready(function() {
            setTimeout(
                function() {
                    $('#unread_messages').fadeOut(1000);
                }, 5000);
        })

    </script>
@endsection
