<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $anggota = [
            [
                'nama_siswa' => 'Fajar Hidayatuloh',
                'eskul_id' => 1
            ],
            [
                'nama_siswa' => 'Dafi Nur',
                'eskul_id' => 2
            ],
            [
                'nama_siswa' => 'Dela Agustina',
                'eskul_id' => 3
            ]
        ];

        foreach($anggota as $v) {
            DB::table('anggotas')->insert($v);
        }
    }
}
