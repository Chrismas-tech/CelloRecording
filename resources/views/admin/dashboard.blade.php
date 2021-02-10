@extends('layouts.app')
@section('content')

    <div class="py-12">

        <div class="mx-auto max-w-7xl">
            <div class="flex flex-inline pb-8">
                <a href="/" class="py-2 px-3 text-4xl dancing_font text-black bg-white border border-gray-300 rounded">
                    Back to the welcome page !
                </a>
            </div>
        </div>

        <div class="mx-auto max-w-7xl">
            <div class="overflow-hidden bg-white">
                <div class="p-6 bg-white rounded border border-gray-300">
                    <p class="text-5xl dancing_font">Welcome to the Administration {{ $admin_name }}
                    </p>
                    @if (Session::has('quotesent'))
                        <div class="mt-5">
                            <p class="px-2 py-3 text-white bg-green-400 rounded">{{ Session::get('quotesent') }}</p>
                        </div>
                    @endif

                    <div class="flex mt-10">
                        <div class="w-6/12">
                            <div>
                                <p class="text-3xl">Users informations :</p>
                            </div>
                            <div class="mt-6">
                                <p class="bg-green-400 mb-3 text-white px-2 py-1 w-max  rounded karma">Users registered :
                                    {{ $nb_users }}
                                </p>
                            </div>
                        </div>
                        <div class="w-6/12">
                            <div>
                                <p class="text-3xl">Orders informations :</p>
                            </div>
                            <div class="mt-6">
                                <p class="bg-red-400 mb-3   text-white px-2 py-1 w-max rounded karma">Orders pending :
                                    {{ $nb_orders_waiting }}
                                </p>
                                <p class="bg-yellow-400 mb-3   text-white px-2 py-1 w-max rounded karma">Orders in revision
                                    :
                                    {{ $nb_orders_revision }}
                                </p>
                                <p class="bg-blue-400 mb-3   text-white px-2 py-1 w-max rounded karma">Orders delivered :
                                    {{ $nb_orders_delivered }}
                                </p>
                                <p class="bg-green-400 mb-3   text-white px-2 py-1 w-max rounded karma">Orders completed :
                                    {{ $nb_orders_completed }}
                                </p>
                            </div>
                        </div>
                    </div>



                    <div class="flex mt-10">
                        <div class="w-6/12">
                            <div>
                                <p class="text-3xl karma">Total of space user on server : </p>
                            </div>
                            <div class="flex">

                                <div class="mt-6">
                                    <p class="bg-red-400 text-xl mb-3 text-white px-2 py-1 w-max  rounded karma">
                                        Music Conversations : {{ $datas_size_file[0] }} Mo
                                    </p>
                                    <p class="bg-blue-400 text-xl mb-3 text-white px-2 py-1 w-max  rounded karma">
                                        Deliveries : {{ $datas_size_file[1] }} Mo
                                    </p>
                                    <p class="bg-yellow-400 text-xl mb-3 text-black px-2 py-1 w-max  rounded karma">
                                        Images : {{ $datas_size_file[2] }} Mo
                                    </p>
                                    <p class="bg-purple-400 text-xl mb-3 text-white px-2 py-1 w-max  rounded karma">
                                        Total : {{ $datas_size_file[3] }} Mo
                                    </p>
                                </div>


                                <div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="w-6/12">
                            <div>
                                <p class="text-3xl">Users informations :</p>
                            </div>
                            <div class="mt-6">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
