<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Kjfd',
            'email' => 'kjfd@test.com',
            'role' => 'kjfd',
            'field' => 'Koordinator KJFD Manajemen Data dan Informasi',
            'password' => Hash::make('kjfddemo'),
        ]);
    }
}
