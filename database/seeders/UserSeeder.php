<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'nama' => 'Ibnu Syawal As-Salim',
            'username' => 'admin',
            'password' => bcrypt('Admin12345'),
        ];

        DB::table('users')->insert($user);
    }
}
