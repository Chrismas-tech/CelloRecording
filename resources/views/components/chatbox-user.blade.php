<div class="p-4 overflow-auto border border-gray-200 shadow" id="scroll_down" style="height:400px;">

    @if ($messages->isEmpty())
        <div>
            <p class="text-xl courgette_font">Describe your project and ask me any questions here :</p>
            <div class="mt-5">

                <ul class="style-type">

                    <li class="flex items-center mb-2">
                        <div class="rounded-full bg-indigo-400 w-2 h-2 mr-3"></div>
                        <p>Upload your music files</p>
                    </li>

                    <li class="mb-2">
                        <div class="flex items-center mb-1">
                            <div class="rounded-full bg-indigo-400 w-2 h-2 mr-3"></div>
                            <p>Tell me the timing where you need a backing track cello above your music, example :</p>
                        </div>

                    </li>
                    <li class="mb-2 ml-6 bg-red-400 w-max rounded px-2 text-white">
                        <p>From 00:30 to 01:50 : cello accompaniment</p>
                        <p>From 01:20 to 02:00 : improvisation</p>
                    </li>

                </ul>
            </div>
        </div>
    @endif

    @foreach ($messages as $message)

        <div class="mb-8">

            @if ($message->direction_send == 1)
                <div class="flex justify-start">
                    <div class="flex mq_font_size_conversation_info">
                        <p class="mr-3 text-xs sm:text-sm text-green-500">{{ $message->admin->name }}</p>
                        <p class="text-xs sm:text-sm text-gray-500">
                            {{ App\Http\Controllers\DateChangeController::date_created_at_to_string($message->created_at) }}
                        </p>
                    </div>
                </div>

                <div class="flex justify-start text-xs sm:text-sm md:text-md lg:text-lg">
                    <div>
                        @if ($message->type == 3)
                            <p class="px-1 py-1 mb-1 text-white bg-gray-400 rounded">You have declined the last offer
                                made
                                by Christophe Luciani
                            </p>
                        @elseif ($message->type == 2)

                            <a href="{{ route('download_music_file_user', [$message->id, $message->type]) }}"
                                class="px-1 py-1 mb-1 flex underline items-center text-white bg-red-400 rounded">
                                <img src="{{ asset('img/download_icon.png') }}" class="w-6 h-6 md:w-10 md:h-10 mr-3 "
                                    alt="">{{ $message->content }}
                            </a>
                        @else
                            <p class="px-1 py-1 mb-1 text-white bg-green-500 rounded">{{ $message->content }}
                            </p>
                        @endif
                    </div>
                </div>
            @else
                <div class="flex justify-end mq_font_size_conversation_info">
                    <div class="flex">
                        <p class="mr-3 text-xs sm:text-sm text-indigo-500">{{ $message->user->name }}</p>
                        <p class="text-xs sm:text-sm text-gray-500">
                            {{ App\Http\Controllers\DateChangeController::date_created_at_to_string($message->created_at) }}
                        </p>
                    </div>
                </div>

                <div class="flex justify-end text-xs sm:text-sm md:text-md lg:text-lg">
                    <div>
                        @if ($message->type == 3)
                            <p class="px-1 py-1 mb-1 text-white bg-gray-400 rounded">You have declined the last offer
                                made
                                by Christophe Luciani
                            </p>
                        @elseif ($message->type == 2)

                            <a href="{{ route('download_music_file_user', [$message->id, $message->type]) }}"
                                class="px-1 py-1 mb-1 flex underline items-center text-white bg-red-400 rounded">
                                <img src="{{ asset('img/download_icon.png') }}" class="w-6 h-6 md:w-10 md:h-10 mr-3"
                                    alt="">{{ $message->content }}
                            </a>

                        @else
                            <p class="px-1 py-1 mb-1 text-white bg-purple-500 rounded">{{ $message->content }}
                            </p>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    @endforeach
</div>

<script>
    $("#scroll_down").scrollTop($("#scroll_down")[0].scrollHeight);

</script>
