@extends('layouts.app')
@section('content')

    <div class="lg:p-12">
        <div class="container mx-auto sm:max-w-xl md:max-w-2xl lg:max-w-7xl">

            <div class="lg:flex">
                <div class="pl-3 pt-5 pb-5 lg:w-4/12 md:mr-5">
                    <div>
                        <p class="text-3xl ">Profile Information</p>
                        <p class="text-sm text-gray-500">Update your account's profile and email address</p>
                    </div>
                    <div x-data="{open:false}" x-cloak class="mt-1">
                        <div class="bg-red-600 text-white rounded text-xl px-2 py-1 py- w-max">
                            <button @click="open=true" class="focus:outline-none">Delete your account</button>
                        </div>

                        <div x-show.transition="open" @click.away="open = false" id="confirm_delete_account"
                            class="bg-white border rounded border-gray-300 p-2 mt-2">
                            <form action="{{ route('delete_account') }}" method="post">
                                @csrf
                                @method('DELETE')
                                <p class="text-red-400">Deleting your account will remove all yourdata, including
                                                                        music files received.</p>
                                <div class="flex justify-center mt-3">
                                    <button type="submit" class="bg-red-600 rounded mr-5 text-white px-2 py-1">Yes</button>
                                    <p class="bg-gray-600 rounded text-white px-2 py-1 cursor-pointer" @click="open=false">
                                        No</p>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

                <div class="lg:w-8/12 p-8 overflow-hidden bg-white border border-gray-300 rounded">

                    <div>
                        <p class="mb-4 text-2xl">Upload a profile photo</p>

                        <form id="form_uploadphoto" action="{{ route('uploadphoto') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <input type="file" name="file" id="file" accept="image/*">

                            <div class="flex items-center" id="upload">
                                <label for="file"
                                    class="px-4 py-2 mr-5 text-white bg-gray-800 rounded cursor-pointer">Upload
                                    your
                                    photo</label>
                            </div>

                            <!-- PROGRESS BAR -->
                            <!-- PROGRESS BAR -->
                            <!-- PROGRESS BAR -->
                            <!-- PROGRESS BAR -->
                            <!-- PROGRESS BAR -->

                            <div id="progress_bar_visible" class="relative mt-5 mb-5 hidden">
                                <div class="flex mb-2 items-center justify-between">
                                    <div>
                                        <span
                                            class="text-xs task font-semibold inline-block py-1 px-2 uppercase rounded-full text-indigo-600 bg-indigo-200">Task
                                            in Progress
                                        </span>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-xs percent font-semibold inline-block text-indigo-600">

                                        </span>
                                    </div>
                                </div>
                                <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-indigo-200">
                                    <div
                                        class="shadow-none progress_bar flex flex-col text-center whitespace-nowrap text-white justify-center bg-indigo-500">
                                    </div>
                                </div>
                            </div>

                            <!-- END PROGRESSBAR -->
                            <!-- END PROGRESSBAR -->
                            <!-- END PROGRESSBAR -->
                            <!-- END PROGRESSBAR -->
                            <!-- END PROGRESSBAR -->

                            <div class="flex items-center justify-end mt-5">
                                <div id="success" class="px-4 hidden py-2 mr-3 text-white bg-green-400"></div>
                                <div id="error" class="px-4 py-2 hidden mr-3 text-white bg-red-400"></div>
                                <button type="submit" class="px-4 py-2 text-white bg-gray-800 rounded">Save</button>
                            </div>
                        </form>
                    </div>



                    <div class="mt-5 mb-5">
                        <hr>
                    </div>


                    <div>
                        <div>
                            <p class="mb-4 text-2xl">Update your Username and Email</p>
                        </div>

                        <form action="{{ route('update_profile') }}" method="POST">
                            @csrf

                            <div>
                                <div>
                                    <label for="name">Name</label>
                                </div>
                                <div>
                                    <input class="rounded w-full bg-gray-200" name="name" type="text"
                                        value="{{ Auth()->user()->name }}">
                                </div>

                                @error('name')
                                    <div class="bg-red-400 text-white px-2 py-3 mt-3 rounded">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-8">
                                <div>
                                    <label for="email">Email</label>
                                </div>
                                <div>
                                    <input class="rounded w-full bg-gray-200" name="email" type="email"
                                        value="{{ Auth()->user()->email }}">
                                </div>

                                @error('email')
                                    <div class="bg-red-400 text-white px-2 py-3 mt-3 rounded">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="flex items-center justify-end mt-8">
                                @if (Session::has('success_update'))
                                    <p class="px-4 py-2 mr-3 text-white bg-green-400">
                                        {{ Session::get('success_update') }}
                                    </p>
                                @endif
                                <button type="submit" class="px-4 py-2 text-white bg-gray-800 rounded">Save</button>
                            </div>
                            <div>
                                <input type="text" name="old_user_name" hidden value="{{ auth()->user()->name }}">
                            </div>
                        </form>
                    </div>

                    <div class="mt-5 mb-5">
                        <hr>
                    </div>


                    <div>
                        <p class="mb-4 text-2xl">Change your password</p>
                    </div>

                    <form action="{{ route('change_password') }}" method="POST">
                        @csrf

                        <div>
                            <div>
                                <label for="password">Current password</label>
                            </div>
                            <div>
                                <input class="rounded w-full bg-gray-200" name="current_password" type="password" value="">
                            </div>
                            @error('current_password')
                                <div class="bg-red-400 text-white px-2 py-3 mt-3 rounded">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <div class="mt-8">
                                <label for="name">New Password</label>
                            </div>
                            <div>
                                <input class="rounded w-full bg-gray-200" name="new_password" type="password">
                            </div>
                            @error('new_password')
                                <div class="bg-red-400 text-white px-2 py-3 mt-3 rounded">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <div class="mt-8">
                                <label for="new_confirm_password">Confirm New Password</label>
                            </div>
                            <div>
                                <input class="rounded w-full bg-gray-200" name="new_confirm_password" type="password">
                            </div>
                            @error('new_confirm_password')
                                <div class="bg-red-400 text-white px-2 py-3 mt-3 rounded">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-8">
                            @if (Session::has('success_password'))
                                <p class="px-4 py-2 mr-3 text-white bg-green-400">
                                    {{ Session::get('success_password') }}
                                </p>
                            @endif
                            <button type="submit" class="px-4 py-2 text-white bg-gray-800 rounded">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            console.log('ready');

            $('#file').change(function() {
                $('#photo').remove();
                var $image =
                    "<img src='{{ asset('img/checked.png') }}' id='photo' class='w-8 h-8' id='photo' alt=''>"
                $('#upload').append($image);
            })
        });

        $('#form_uploadphoto').ajaxForm({

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

                if (res === "File has been successfully uploaded !") {
                    console.log(res);
                    console.log('success')
                    $('#success').html(res)
                    $('#success').removeClass("hidden");
                    $('#error').addClass("hidden");

                    setTimeout(() => {
                        window.location.replace("http://cellorecording.ml/profile");
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
