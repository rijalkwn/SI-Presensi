<?php

namespace Database\Seeders;

use App\Models\Karyawan;
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
            'nik' => '1231111111111111',
            'nama' => 'Rijal kurniawan',
            'email' => 'rijal@gmail.com',
            'kepegawaian_id' => '1',
        ]);
        DB::table('karyawans')->insert([
            'nik' => '1241111111111111',
            'nama' => 'kurniawan',
            'email' => 'kurniawan@gmail.com',
            'kepegawaian_id' => '2',
        ]);
    }
}
