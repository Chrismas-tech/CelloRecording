@extends('layouts.app')
@section('content')

    <div class="sm:py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">

                <div class="flex justify-center bg-green-200 pt-4 pb-4">
                    <a href="/list_conversation_admin" class="px-4 py-2 text-white bg-gray-800 rounded">Back to the
                        Conversations list</a>
                </div>

                <x-chatbox-admin :messages="$messages"></x-chatbox-admin>

                <div class="p-6 bg-gray-800 border-b border-gray-200 max-h-30">

                    <!-- ADD MUSIC FILE -->

                    <form id="form_uploadmusic" action="{{ route('upload_music_admin',[$user->id]) }}" method="POST">
                        @csrf

                        <div class="flex mb-5 right-10">

                            <label for="file" class="flex items-end mr-5 text-white bg-gray-800 rounded cursor-pointer">
                                <div>
                                    <svg class="w-7 h-7 text-white fill-current" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 792 792">
                                        <g>
                                            <g>
                                                <g>
                                                    <path
                                                        d="M544.5,99v495c0,82.021-66.479,148.5-148.5,148.5S247.5,676.021,247.5,594V148.5c0-54.673,44.327-99,99-99 s99,44.327,99,99V594c0,27.349-22.176,49.5-49.5,49.5c-27.349,0-49.5-22.151-49.5-49.5V198H297v396c0,54.673,44.327,99,99,99 s99-44.327,99-99V148.5C495,66.479,428.521,0,346.5,0S198,66.479,198,148.5v470.25C210.202,716.389,295.045,792,396,792 s185.798-75.611,198-173.25V99H544.5z" />
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <div>
                                    <p>Add music files here...</p>
                                </div>
                            </label>

                            <input type="file" id="file" name="file[]" accept="audio/*"
                                class="focus:outline-none cursor-pointer" multiple>   

                            <div id="div_send_music_file" class="w-max hidden">
                                <button class="px-2 py-1 text-white bg-red-500 rounded" type="submit">
                                    Send the music files
                                </button>
                            </div>

                        </div>

                        <div id="success" class="px-4 hidden py-2 mr-3 text-white bg-green-400"></div>
                        <div id="error" class="px-4 py-2 hidden mr-3 text-white bg-red-400"></div>


                        <!-- PROGRESS BAR -->
                        <!-- PROGRESS BAR -->
                        <!-- PROGRESS BAR -->
                        <!-- PROGRESS BAR -->
                        <!-- PROGRESS BAR -->

                        <div class="flex w-full items-center mt-5 ">
                            <div id="progress_bar_visible" class="relative mr-5 w-11/12 hidden">
                                <div class="flex mb-2 items-center justify-between">
                                    <div>
                                        <span
                                            class="text-xs task font-semibold inline-block py-1 px-2 uppercase rounded-full text-indigo-600 bg-indigo-200">Task
                                            in Progress
                                        </span>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-xs percent font-semibold inline-block text-white">
                                            %
                                        </span>
                                    </div>
                                </div>
                                <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-indigo-200">
                                    <div
                                        class="shadow-none progress_bar flex flex-col text-center whitespace-nowrap text-white justify-center bg-indigo-500">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>

                    <!-- END PROGRESSBAR -->
                    <!-- END PROGRESSBAR -->
                    <!-- END PROGRESSBAR -->
                    <!-- END PROGRESSBAR -->
                    <!-- END PROGRESSBAR -->

                    <div class="flex">
                        <div class="px-4 py-2 mb-6 text-white bg-red-500 rounded"> <a
                                href="{{ route('quote-form', ['user_id' => $user->id]) }}">Propose a quote to the
                                client</a>
                        </div>
                    </div>

                    <form action="{{ route('new_conversation_admin', ['user_id' => $user->id]) }}" method="POST">
                        @csrf
                        <div class="flex items-end">
                            <div class="w-full mr-3">
                                <textarea type="text" name="message" rows="4"
                                    class="w-full p-2 border-gray-400 rounded"
                                    placeholder="Send a message to the client here..."></textarea>
                            </div>
                            <div>
                                <button class="focus:outline-none" type="submit">
                                    <svg class="w-7 h-7 text-green-600 fill-current" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path d="M0 0l20 10L0 20V0zm0 8v4l10-2L0 8z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>
                    @error('message')
                        <div class="flex flex-row">
                            <p class="px-4 py-2 mt-2 text-white bg-gray-800 rounded">{{ $message }}</p>
                        </div>
                    @enderror

                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#file').change(function() {
                $('#div_send_music_file').removeClass('hidden');
            })
        });

        $('#form_uploadmusic').ajaxForm({

            beforeSend: function() {
                $('#progress_bar_visible').removeClass("hidden");
                $progress_bar = $('.progress_bar')
                $percent = $('.percent')
                $task = $('.task')

                $percent_begin = '0%';
                $progress_bar.width($percent_begin);
                $percent.html($percent_begin);
            },

            uploadProgress: function(event, position, total, percentComplete) {
                $percent_complete = percentComplete + '%';
                $progress_bar.width($percent_complete);
                $percent.html($percent_complete);
            },

            success: function(res) {

                if (res === "Files have been successfully uploaded !") {
                    console.log(res);
                    console.log('success')
                    $('#success').html(res)
                    $('#success').removeClass("hidden");
                    $('#error').addClass("hidden");

                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);

                } else {
                    console.log(res);
                    console.log('error')
                    $('#progress_bar_visible').addClass("hidden");
                    $('#error').html(res)
                    $('#error').removeClass("hidden");
                }

            }


        })

    </script>
@endsection
