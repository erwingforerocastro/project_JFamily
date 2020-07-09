<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => 'admin@gmail.com',
            'age'=>rand(10, 100),
            'identification'=>rand(1000000, 9999999),
            'phone'=>rand(3000000000, 3999999999),
            'ocupation'=>'Sin ocupacion',
            'image'=>'generic.png',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'password' => Hash::make('password'),
        ]);
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => 'admin2@gmail.com',
            'age'=>rand(10, 100),
            'identification'=>rand(1000000, 9999999),
            'phone'=>rand(3000000000, 3999999999),
            'ocupation'=>'Sin ocupacion',
            'image'=>'profile/generic.png',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'password' => Hash::make('password'),
        ]);
    }
}
