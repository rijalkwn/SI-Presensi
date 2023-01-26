<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('karyawans')->insert([
            'nip' => '123',
            'nama' => 'Rijal kurniawan',
            'email' => 'rijal@gmail.com',
            'jabatan' => 'Direktur',
        ]);
    }
}
