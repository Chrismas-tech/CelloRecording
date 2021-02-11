@extends('layouts.app')
@section('content')

    <div class="py-12">

        <div class="mx-auto max-w-7xl">
            <div class="flex flex-inline pb-8">
                <a href="/" class="py-2 px-3 text-4xl dancing_font text-black bg-gray-100 border border-gray-300 rounded">
                    Back to the welcome page !
                </a>
            </div>
        </div>

        <div class="mx-auto max-w-7xl">
            <div class="overflow-hidden bg-white">
                <div class="p-6 bg-white rounded border border-gray-300">
                    <p class="text-5xl  dancing_font rounded text-black w-max px-2 py-2">Welcome to the
                        Administration {{ $admin_name }}
                    </p>
                    @if (Session::has('quotesent'))
                        <div class="mt-5">
                            <p class="px-2 py-3 text-white bg-green-400 rounded">{{ Session::get('quotesent') }}</p>
                        </div>
                    @endif

                    <div class="flex mt-10">
                        <div class="w-6/12">
                            <div>
                                <p class="text-3xl">Users informations </p>
                            </div>
                            <div class="mt-3">
                                <p class="bg-green-400 mb-3 text-xl text-white px-2 py-1 w-max  rounded ">Users registered
                                    {{ $nb_users }}
                                </p>
                            </div>
                        </div>
                        <div class="w-6/12">
                            <div>
                                <p class="text-3xl">Orders informations </p>
                            </div>
                            <div class="mt-3">
                                <p class="bg-red-400 mb-3  text-xl text-white px-2 py-1 w-max rounded karma">Orders pending
                                    :
                                    {{ $nb_orders_waiting }}
                                </p>
                                <p class="bg-yellow-400 mb-3  text-xl text-white px-2 py-1 w-max rounded karma">Orders in
                                    revision
                                    :
                                    {{ $nb_orders_revision }}
                                </p>
                                <p class="bg-blue-400 mb-3 text-xl  text-white px-2 py-1 w-max rounded karma">Orders
                                    delivered :
                                    {{ $nb_orders_delivered }}
                                </p>
                                <p class="bg-green-400 mb-3  text-xl text-white px-2 py-1 w-max rounded karma">Orders
                                    completed :
                                    {{ $nb_orders_completed }}
                                </p>
                            </div>
                        </div>
                    </div>



                    <div class="flex mt-10">
                        <div class="w-6/12">
                            <div>
                                <p class="text-3xl">Total of space used by users </p>
                            </div>
                            <div class="flex">

                                <div class="mt-3">
                                    <p class="bg-red-500 text-xl mb-3 text-white px-2 py-1 w-max  rounded ">
                                        Music Conversations : {{ $datas_size_file[0] }} Mo
                                    </p>
                                    <p class="bg-blue-500 text-xl mb-3 text-white px-2 py-1 w-max  rounded ">
                                        Deliveries : {{ $datas_size_file[1] }} Mo
                                    </p>
                                    <p class="bg-green-500 text-xl mb-3 text-white px-2 py-1 w-max  rounded ">
                                        Images : {{ $datas_size_file[2] }} Mo
                                    </p>
                                    <p class="bg-yellow-500 mt-10 text-xl mb-3 text-white px-2 py-1 w-max  rounded ">
                                        Total : <span id="total_space_music_files">{{ $datas_size_file[3] }}</span> Mo
                                    </p>
                                </div>


                                <div>

                                </div>
                            </div>
                        </div>
                        <div class="w-6/12">

                            <div>
                                <div>
                                    <p class="text-3xl">Space used by the music files </p>

                                </div>
                                <div class="flex justify-between mt-3">
                                    <p id="width_space_used_html" class="text-xl">Space used by the music files </p>
                                    <p class="text-xl">100%</p>
                                </div>
                                <div id="total_space_server_width" class="bg-blue-200 rounded-full text-white">
                                    <div id="width_space_used" class="z-10 p-1 bg-blue-600 rounded-full text-white">
                                    </div>
                                </div>
                            </div>
                            <div class="mt-6">
                                <p class="text-3xl">Disk Space</p>
                            </div>
                            <div class="mt-3">
                                <div>
                                    <p class="bg-blue-500 text-white text-xl mb-3 px-2 py-1 w-max rounded ">
                                        Total space : <span id="total_space_server_html">{{ $total_space_server }}</span>
                                        Go
                                    </p>
                                    <p class="bg-blue-500 text-white text-xl mb-3 px-2 py-1 w-max rounded ">
                                        Total free space remaining : {{ $free_space_server_remaining }}</span> Go
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {

                /* Longueur de la div en px qui représente 100% */
                $total_space_server_width = $('#total_space_server_width').width();
                $total_space_server_html = parseInt($('#total_space_server_html').html());

                /* Space used on server + conversion to number, en Go */
                $total_space_music_files = (parseInt($('#total_space_music_files').html()) / Math.pow(10, 3));
                //console.log($total_space_music_files + ' Go');

                /* Taille de la width en pixel = (100% x fichiers serveur) / total espace disk */
                $width_space_used = ($total_space_server_width * $total_space_music_files /$total_space_server_html);
                $width_space_used_decimal = $width_space_used.toFixed(2);
               // console.log($width_space_used_decimal);
                $('#width_space_used').width($width_space_used_decimal);

                /* Calcul du pourcentage écrit */
                $space_used_html = (100 * $width_space_used) / $total_space_server_width;
                $space_used_html_decimal = $space_used_html.toFixed(2);
                $('#width_space_used_html').html($space_used_html_decimal + '%');
            })

        </script>

    @endsection
