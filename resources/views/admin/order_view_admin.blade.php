@extends('layouts.app')
@section('content')

    @if ($order->status == 3)

        <div class="pt-12 pb-6">

            <div class="mx-auto max-w-7xl">

                <div>

                    <div class="border-b border-gray-500">
                        <h1 class="text-6xl text-gray-500">Deliver the work</h1>
                    </div>

                </div>

            </div>
        </div>

        <div class="mx-auto max-w-7xl pb-12">

            <div class="mr-10">

                <div id="minuteur_result" class="flex text-3xl mt-5 mb-5">
                    <p class="bg-red-400 text-white rounded px-2 py-1 mr-5">Remaining Time :
                    </p>
                    <p class="bg-white border-gray-400 border rounded px-2 py-1 mr-5">
                        <span id="day">{{ $minuteur_result[0] }}</span> days
                        <span id="hour">{{ $minuteur_result[1] }}</span> hours
                        <span id="min">{{ $minuteur_result[2] }}</span> minutes
                        <span id="sec">{{ $minuteur_result[3] }}</span> secondes
                    </p>
                </div>
                <div>
                    @csrf
                    <input id="order_created_at" hidden type="text" value="{{ $order->created_at }}">
                    <input id="nb_days" hidden type="text" value="{{ $order->nb_days }}">
                </div>

                <div class="mt-8 mb-8">
                    <p class="text-4xl dancing_font">Summary of the order #{{ $order->id }} by {{ $order->user->name }}
                    </p>
                    <p class="text-sm text-gray-500">Upload the work done and send it to the client</p>
                </div>
            </div>
            <div class="p-8 overflow-hidden sm:rounded-lg bg-red-400 border rounded">

                <div>
                    <div class="mb-3">
                        <label for="title" class="px-2 text-white bg-gray-800 rounded">Title</label>
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
                        <label for="description" class="px-2 text-white bg-gray-800 rounded">Description</label>
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
                        <label for="days" class="px-2 text-white bg-gray-800 rounded">Days to complete the work</label>
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
                        <label for="price" class="px-2 text-white bg-gray-800 rounded">Price in €</label>
                    </div>
                    <div class="mb-6">
                        <input type="number" disabled max="1000" min="1" name="price"
                            class="w-full p-2 border-gray-400 rounded min-h-8 max-h-20"
                            value="{{ $order->price / 100 }}">
                        @error('price')
                            <div class="flex flex-row">
                                <p class="mt-1 text-white">{{ $message }}</p>
                            </div>
                        @enderror
                    </div>

                </div>

                <form action="{{ route('upload_delivery') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div id="checked" class="flex items-center">
                        <label class="text-white text-xl  px-4 py-2 cursor-pointer bg-gray-700 rounded" for="file">Upload
                            the work</label>
                        <input class="" type="file" id="file" name="file[]" accept="audio/*" multiple>
                    </div>

                    <div>
                        <input hidden type="text" name="order_id" value="{{ $order->id }}">
                        <input hidden type="text" name="user_id" value="{{ $order->user_id }}">
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
                                    class="text-xs task font-semibold inline-block py-1 px-2 uppercase rounded-full text-white bg-blue-500">Task
                                    in Progress
                                </span>
                            </div>
                            <div class="text-right">
                                <span class="text-xs percent font-semibold inline-block text-white">

                                </span>
                            </div>
                        </div>
                        <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-indigo-200">
                            <div
                                class="shadow-none progress_bar flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500">
                            </div>
                        </div>
                    </div>

                    <!-- END PROGRESSBAR -->
                    <!-- END PROGRESSBAR -->
                    <!-- END PROGRESSBAR -->
                    <!-- END PROGRESSBAR -->
                    <!-- END PROGRESSBAR -->

                    <div class="flex justify-end">
                        <div id="success" class="px-4 hidden py-2 mr-3 text-white bg-green-400"></div>
                        <div id="error" class="px-4 py-2 hidden mr-3 text-white bg-red-500"></div>
                        <button type="submit"
                            class="focus:outline-none px-4 py-2 text-xl text-white bg-gray-700 rounded">Deliver
                        </button>
                    </div>
                </form>

            </div>
        </div>

    @elseif($order->status == 4)


        <div class="pt-12 pb-6">

            <div class="mx-auto max-w-7xl">

                <div>

                    <div class="border-b border-gray-500">
                        <h1 class="text-6xl text-gray-500">Re-Deliver the work</h1>
                    </div>

                </div>

            </div>
        </div>

        <div class="mx-auto max-w-7xl pb-12">

            <div class="mr-10">
                <div>
                    @csrf
                    <input id="order_created_at" hidden type="text" value="{{ $order->created_at }}">
                    <input id="nb_days" hidden type="text" value="{{ $order->nb_days }}">
                </div>

                <div class="mt-8 mb-8">
                    <p class="text-4xl dancing_font">Summary of the order #{{ $order->id }} by
                        {{ $order->user->name }}</p>
                    <p class="text-sm text-gray-500">Re-Upload the work done and send it to the client</p>
                </div>
            </div>
            <div class="p-8 overflow-hidden sm:rounded-lg bg-yellow-300 border rounded">

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
                            class="w-full p-2 border-gray-400 rounded min-h-8 max-h-20"
                            value="{{ $order->price / 100 }}">
                        @error('price')
                            <div class="flex flex-row">
                                <p class="mt-1 text-white">{{ $message }}</p>
                            </div>
                        @enderror
                    </div>

                </div>


                <div class="mb-10 mt-10">
                    <div class="border-b border-black mb-5">
                        <h1 class="text-3xl ">Files already delivered for this order</h1>
                    </div>
                    <div>
                        @foreach ($deliveries_order as $delivery_order)
                            <div>
                                <a href="{{ route('download_delivery_file', [$delivery_order->id, $delivery_order->user_id]) }}"
                                    class="mb-3 flex text-gray-500 w-max px-2 py-3 bg-white underline items-center  rounded"><img
                                        src="{{ asset('img/download_icon.png') }}" class="w-7 h-7 mr-3"
                                        alt="">{{ $delivery_order->file_delivery }}
                                </a>
                            </div>
                            <div class="mt-5 mb-10">
                                <h1 class="text-2xl text-black">Listen to the track</h1>
                                <audio class="focus:outline-none" controls
                                    src="{{ asset('/storage/deliveries/' . $delivery_order->user_id . '/' . $delivery_order->file_delivery) }}">
                                    Your browser does not support the
                                    <code>audio</code> element.
                                </audio>
                            </div>
                        @endforeach
                    </div>

                </div>

                <form action="{{ route('upload_delivery') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div id="checked" class="flex items-center">
                        <label class="text-white text-xl  px-4 py-2 cursor-pointer bg-gray-700 rounded" for="file">Upload
                            the work</label>
                        <input class="" type="file" id="file" name="file[]" accept="audio/*" multiple>
                    </div>

                    <div>
                        <input hidden type="text" name="order_id" value="{{ $order->id }}">
                        <input hidden type="text" name="user_id" value="{{ $order->user_id }}">
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
                                    class="text-xs task font-semibold inline-block py-1 px-2 uppercase rounded-full text-white bg-blue-500">Task
                                    in Progress
                                </span>
                            </div>
                            <div class="text-right">
                                <span class="text-xs percent font-semibold inline-block text-white">

                                </span>
                            </div>
                        </div>
                        <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-indigo-200">
                            <div
                                class="shadow-none progress_bar flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500">
                            </div>
                        </div>
                    </div>

                    <!-- END PROGRESSBAR -->
                    <!-- END PROGRESSBAR -->
                    <!-- END PROGRESSBAR -->
                    <!-- END PROGRESSBAR -->
                    <!-- END PROGRESSBAR -->

                    <div class="flex justify-end">
                        <div id="success" class="px-4 hidden py-2 mr-3 text-white bg-green-400"></div>
                        <div id="error" class="px-4 py-2 hidden mr-3 text-white bg-red-400"></div>
                        <button type="submit"
                            class="focus:outline-none px-4 py-2 text-xl text-white bg-gray-700 rounded">Deliver
                        </button>
                    </div>
                </form>

            </div>
        </div>



    @elseif($order->status == 5)

        <div class="pt-12 pb-6">

            <div class="mx-auto max-w-7xl">

                <div>

                    <div class="border-b border-gray-500">
                        <h1 class="text-6xl text-gray-500">Order Completed</h1>
                    </div>

                </div>

            </div>
        </div>

        <div class="mx-auto max-w-7xl pb-12">

            <div class="mr-10">
                <div>
                    @csrf
                    <input id="order_created_at" hidden type="text" value="{{ $order->created_at }}">
                    <input id="nb_days" hidden type="text" value="{{ $order->nb_days }}">
                </div>

                <div class="mt-8 mb-8">
                    <p class="text-4xl dancing_font">Summary of the order #{{ $order->id }} by
                        {{ $order->user->name }}</p>
                    <p class="text-sm text-gray-500">Re-Upload the work done and send it to the client</p>
                </div>
            </div>
            <div class="p-8 overflow-hidden sm:rounded-lg bg-green-400 border rounded">

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
                            class="w-full p-2 border-gray-400 rounded min-h-8 max-h-20"
                            value="{{ $order->price / 100 }}">
                        @error('price')
                            <div class="flex flex-row">
                                <p class="mt-1 text-white">{{ $message }}</p>
                            </div>
                        @enderror
                    </div>

                </div>


                <div class="mt-10">
                    <div class="border-b border-white mb-5">
                        <h1 class="text-3xl text-white">Files already delivered for this order</h1>
                    </div>
                    <div>
                        @foreach ($deliveries_order as $delivery_order)
                            <div>
                                <a href="{{ route('download_delivery_file', [$delivery_order->id]) }}"
                                    class="mb-3 flex text-gray-500 w-max px-2 py-3 bg-white underline items-center  rounded"><img
                                        src="{{ asset('img/download_icon.png') }}" class="w-7 h-7 mr-3"
                                        alt="">{{ $delivery_order->file_delivery }}
                                </a>
                            </div>
                            <div class="mt-5 mb-10">
                                <h1 class="text-2xl text-black">Listen to the track</h1>
                                <audio class="focus:outline-none" controls
                                    src="{{ asset('/storage/deliveries/' . $delivery_order->user_id . '/' . $delivery_order->file_delivery) }}">
                                    Your browser does not support the
                                    <code>audio</code> element.
                                </audio>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>

    @elseif($order->status == 1)

        <div class="pt-12 pb-6">

            <div class="mx-auto max-w-7xl">

                <div>
                    @if ($order->nb_revision == 0)
                        <div class="border-b border-gray-500">
                            <h1 class="text-6xl text-gray-500">Order re-delivered</h1>
                        </div>
                    @else
                        <div class="border-b border-gray-500">
                            <h1 class="text-6xl text-gray-500">Order delivered</h1>
                        </div>
                    @endif
                </div>

            </div>
        </div>

        <div class="mx-auto max-w-7xl pb-12">

            <div class="mr-10">
                <div>
                    @csrf
                    <input id="order_created_at" hidden type="text" value="{{ $order->created_at }}">
                    <input id="nb_days" hidden type="text" value="{{ $order->nb_days }}">
                </div>

                <div class="mb-8">
                    <p class="text-4xl dancing_font">Summary of the order #{{ $order->id }} by
                        {{ $order->user->name }}</p>
                    <p class="text-sm text-gray-500">Re-Upload the work done and send it to the client</p>
                </div>
            </div>
            <div class="p-8 overflow-hidden bg-blue-400 border rounded">

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
                            class="w-full p-2 border-gray-400 rounded min-h-8 max-h-20"
                            value="{{ $order->price / 100 }}">
                        @error('price')
                            <div class="flex flex-row">
                                <p class="mt-1 text-white">{{ $message }}</p>
                            </div>
                        @enderror
                    </div>

                </div>


                <div class="mt-10">
                    <div class="border-b border-white mb-5">
                        <h1 class="text-3xl text-white">Files already delivered for this order</h1>
                    </div>
                    <div>
                        @foreach ($deliveries_order as $delivery_order)
                            <div>
                                <a href="{{ route('download_delivery_file', [$delivery_order->id, $delivery_order->user_id]) }}"
                                    class="mb-3 flex text-gray-500 w-max px-2 py-3 bg-white underline items-center  rounded"><img
                                        src="{{ asset('img/download_icon.png') }}" class="w-7 h-7 mr-3"
                                        alt="">{{ $delivery_order->file_delivery }}
                                </a>
                            </div>
                            <div class="mt-5 mb-10">
                                <h1 class="text-2xl text-black">Listen to the track</h1>
                                <audio class="focus:outline-none" controls
                                    src="{{ asset('/storage/deliveries/' . $delivery_order->user_id . '/' . $delivery_order->file_delivery) }}">
                                    Your browser does not support the
                                    <code>audio</code> element.
                                </audio>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    @endif

    <script>
        /* On convertit les chiffres texte en number */

        $sec = parseInt(($('#sec').html()));
        $min = parseInt(($('#min').html()));
        $hour = parseInt(($('#hour').html()));
        $day = parseInt(($('#day').html()));

        setInterval(() => {
            $sec -= 1;

            /* Si le compteur secondes < 0 */
            // secondes -> 59
            // minutes - 1

            if ($sec < 0) {
                $sec = 59;
                $min -= 1;
            }

            if ($min < 0) {
                $min = 59;
                $hour -= 1;
            }

            if ($hour < 0) {
                $hour = 23;
                $day -= 1;
            }

            $('#sec').html($sec);
            $('#min').html($min);
            $('#hour').html($hour);
            $('#hour').html($hour);
            $('#day').html($day);

            if ($day < 0) {
                $('#minuteur_result').empty();
                $('#minuteur_result').append('<p class="bg-red-500 text-white rounded px-2 py-1 mr-5">Attention ! Le délai de livraison a été dépassé !</p>');

            }

        }, 1000);


        if ($('#sec').html($sec) < 0) {
            console.log('yolo');
            $sec = 59;
        }


        $(document).ready(function() {

            $('form').ajaxForm({

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
                            window.location.replace(
                                "http://cellorecording.test:8080/orders_admin");
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

            $('#checked').change(function() {
                $('#remove_checked').remove()
                $image =
                    "<img src='{{ asset('img/checked.png') }}' id='remove_checked' class='w-8 h-8 ml-5' alt=''> ";
                $('#checked').append($image);
            })
        });

    </script>
@endsection
