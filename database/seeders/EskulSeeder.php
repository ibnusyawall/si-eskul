<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class EskulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $eskul = [
            [
                'nama_eskul' => 'Ikatan Remaja Masjid',
            ],
            [
                'nama_eskul' => 'Jurnalis Sekolah'
            ],
            [
                'nama_eskul' => 'English Club'
            ],
            [
                'nama_eskul' => 'Kewirausahaan'
            ],
            [
                'nama_eskul' => 'Palang Merah Remaja'
            ],
            [
                'nama_eskul' => 'Bandung Karate Club'
            ]
        ];

        foreach($eskul as $v) {
            DB::table('eskuls')->insert($v);
        }
    }
}
