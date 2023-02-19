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
            'nama' => 'Administrator',
            'email' => 'admin1@gmail.com',
            'password' => Hash::make('123'),
            'role' => 'admin',
        ]);
        DB::table('users')->insert([
            'nik' => '2222222222222222',
            'nama' => 'Administrator',
            'email' => 'admin2@gmail.com',
            'password' => Hash::make('123'),
            'role' => 'admin',
        ]);
        DB::table('users')->insert([
            'nik' => '123',
            'nama' => 'Rijal kurniawan',
            'email' => 'rijal@gmail.com',
            'password' => Hash::make('123'),
            'role' => 'user',
        ]);
        DB::table('users')->insert([
            'nik' => '124',
            'nama' => 'Lutfiani',
            'email' => 'lutfiani@gmail.com',
            'password' => Hash::make('123'),
            'role' => 'user',
        ]);
        DB::table('users')->insert([
            'nik' => '125',
            'nama' => 'Paijo',
            'email' => 'paijo@gmail.com',
            'password' => Hash::make('123'),
            'role' => 'user',
        ]);
        DB::table('users')->insert([
            'nik' => '126',
            'nama' => 'King',
            'email' => 'king@gmail.com',
            'password' => Hash::make('123'),
            'role' => 'user',
        ]);
    }
}
