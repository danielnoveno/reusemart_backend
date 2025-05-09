<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Provinsi;
use Illuminate\Support\Facades\DB;

class ProvinsiSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // Truncate the table
        Provinsi::truncate();

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $provinsis = [
            ['id_provinsi' => 14, 'nama_provinsi' => 'DAERAH ISTIMEWA YOGYAKARTA'],
        ];

        foreach ($provinsis as $provinsi) {
            Provinsi::create($provinsi);
        }
    }
}
