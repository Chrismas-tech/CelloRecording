<div class="p-4 overflow-auto border border-gray-200 shadow" id="scroll_down" style="height:400px">
    @foreach ($messages as $message)

        <div class="mb-8">
            @if ($message->from == 'Christophe Luciani')

                <div class="flex justify-end">

                    <div class="flex">
                        <p class="mr-3 text-sm text-green-500">{{ $message->from }}</p>
                        <p class="text-sm text-gray-500">
                            {{ App\Http\Controllers\DateChangeController::date_created_at_to_string($message->created_at) }}
                        </p>
                    </div>
                </div>

                <div class="flex justify-end text-xs sm:text-sm md:text-md lg:text-lg">
                    <div>
                        @if ($message->type === 'automatic_message')
                        <p class="px-1 py-1 mb-1 text-white bg-gray-500 rounded">This is an automatic message, the
                            client has declined your last offer
                        </p>
                    @elseif ($message->type === 'download_file')
                        <a href="{{ route('download_music_file_admin', [$message->id, $message->user_id]) }}"
                            class="px-1 py-1 mb-1 flex underline items-center text-white bg-red-400 rounded"><img
                                src="{{ asset('img/download_icon.png') }}" class="w-6 h-6 md:w-10 md:h-10 mr-3"
                                alt="">{{ $message->content }}
                        </a>
                    @else
                    <p class="px-1 py-1 mb-1 text-white bg-green-500 rounded">{{ $message->content }}
                    </p>
                    @endif
                       
                    </div>
                </div>


            @else
                <div class="flex justify-start text-xs sm:text-sm md:text-md lg:text-lg">
                    <div class="flex">
                        <p class="mr-3 text-sm text-indigo-500">{{ $message->from }}</p>
                        <p class="text-sm text-gray-500">
                            {{ App\Http\Controllers\DateChangeController::date_created_at_to_string($message->created_at) }}
                        </p>
                    </div>
                </div>

                <div class="flex justify-start text-xs sm:text-sm md:text-md lg:text-lg">

                    <div>
                        @if ($message->type === 'automatic_message')
                            <p class="px-1 py-1 mb-1 text-white bg-gray-500 rounded">This is an automatic message, the
                                client has declined your last offer
                            </p>
                        @elseif ($message->type === 'download_file')
                            <a href="{{ route('download_music_file_admin', [$message->id,$message->user_id]) }}"
                                class="px-1 py-1 mb-1 flex underline items-center text-white bg-red-400 rounded"><img
                                    src="{{ asset('img/download_icon.png') }}" class="w-6 h-6 md:w-10 md:h-10 mr-3"
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
    $(document).ready(function() {

        $("#scroll_down").scrollTop($("#scroll_down")[0].scrollHeight);

    });
</script>
