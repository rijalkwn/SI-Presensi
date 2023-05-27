<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            'nik' => '1111111111111111',
            'nama' => 'Admin Satu',
            'email' => 'admin1@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);
        DB::table('users')->insert([
            'nik' => '2222222222222222',
            'nama' => 'Admin Dua',
            'email' => 'admin2@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);
        DB::table('users')->insert([
            'nik' => '1231111111111111',
            'nama' => 'Rijal kurniawan',
            'email' => 'rijal@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'user',
        ]);
        DB::table('users')->insert([
            'nik' => '1241111111111111',
            'nama' => 'kurniawan',
            'email' => 'kurniawan@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'user',
        ]);

    }
}
