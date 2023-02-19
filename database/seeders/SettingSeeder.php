<?php

namespace Database\Seeders;

use App\Models\Setting;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'jam_masuk' => '08:00:00',
            'jam_pulang' => '17:00:00',
            'lat' => '-7.0549617827935815',
            'lng' => '110.44325249453608',
            'radius' => '50',
        ]);
    }
}
