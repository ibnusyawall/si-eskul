<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class BabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bab = [
            [
                'nama_bab' => 'BAB I PENDAHULUAN',
                'eskul_id' => 1
            ],
            [
                'nama_bab' => 'BAB II NAMA, TARGET DAN JADWAL KEGIATAN',
                'eskul_id' => 1
            ],
            [
                'nama_bab' => 'BAB III RENCANA PROGRAM KERJA',
                'eskul_id' => 1
            ],
            [
                'nama_bab' => 'BAB IV PENUTUP',
                'eskul_id' => 1
            ],
            [
                'nama_bab' => 'BAB I PENDAHULUAN',
                'eskul_id' => 2
            ],
            [
                'nama_bab' => 'BAB II NAMA, TARGET DAN JADWAL KEGIATAN',
                'eskul_id' => 2
            ],
            [
                'nama_bab' => 'BAB III RENCANA PROGRAM KERJA',
                'eskul_id' => 2
            ],
            [
                'nama_bab' => 'BAB IV PENUTUP',
                'eskul_id' => 2
            ],
            [
                'nama_bab' => 'BAB I PENDAHULUAN',
                'eskul_id' => 3
            ],
            [
                'nama_bab' => 'BAB II NAMA, TARGET DAN JADWAL KEGIATAN',
                'eskul_id' => 3
            ],
            [
                'nama_bab' => 'BAB III RENCANA PROGRAM KERJA',
                'eskul_id' => 3
            ],
            [
                'nama_bab' => 'BAB IV PENUTUP',
                'eskul_id' => 3
            ],
            [
                'nama_bab' => 'BAB I PENDAHULUAN',
                'eskul_id' => 4
            ],
            [

                'nama_bab' => 'BAB II NAMA, TARGET DAN JADWAL KEGIATAN',
                'eskul_id' => 4
            ],
            [

                'nama_bab' => 'BAB III RENCANA PROGRAM KERJA',
                'eskul_id' => 4
            ],
            [

                'nama_bab' => 'BAB IV PENUTUP',
                'eskul_id' => 4
            ],
            [
                'nama_bab' => 'BAB I PENDAHULUAN',
                'eskul_id' => 5
            ],
            [
                'nama_bab' => 'BAB II NAMA, TARGET DAN JADWAL KEGIATAN',
                'eskul_id' => 5
            ],
            [
                'nama_bab' => 'BAB III RENCANA PROGRAM KERJA',
                'eskul_id' => 5
            ],
            [
                'nama_bab' => 'BAB IV PENUTUP',
                'eskul_id' => 5
            ],
            [
                'nama_bab' => 'BAB I PENDAHULUAN',
                'eskul_id' => 6
            ],
            [
                'nama_bab' => 'BAB II NAMA, TARGET DAN JADWAL KEGIATAN',
                'eskul_id' => 6
            ],
            [
                'nama_bab' => 'BAB III RENCANA PROGRAM KERJA',
                'eskul_id' => 6
            ],
            [
                'nama_bab' => 'BAB IV PENUTUP',
                'eskul_id' => 6
            ]
        ];

        foreach($bab as $v) {
            DB::table('babs')->insert($v);
        }
    }
}
