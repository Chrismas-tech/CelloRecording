<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo"Username :" (env('PASSWORD_ADMIN'))."\n"
        ."Password :" (env('USERNAME_ADMIN'))."\n";
      
        DB::table('admins')->insert([
            'name' => env('USERNAME_ADMIN'),
            'password' => Hash::make(env('PASSWORD_ADMIN')),
        ]);
    }
}
