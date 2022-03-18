<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class SubBabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subbab = [
            [
                'nama_subbab' => 'Pengertian',
                'isi_subbab' => 'Lorem ipsum dolor sit amet',
                'bab_id' => 21
            ]
        ];

        foreach($subbab as $v) {
            DB::table('sub_babs')->insert($v);
        }
    }
}
