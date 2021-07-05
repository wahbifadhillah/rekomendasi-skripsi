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
            'name' => 'Yusi Tyroni Mursityo, S.Kom., M.AB.',
            'email' => 'yusi_tyro@ub.ac.id',
            'password' => Hash::make('123kaprodi'),
        ]);
        DB::table('users')->insert([
            'name' => 'Nanang Yudi Setiawan, S.T., M.Kom.',
            'email' => 'nanang@ub.ac.id',
            'password' => Hash::make('123mdi'),
        ]);
        DB::table('users')->insert([
            'name' => 'Djoko Pramono, S.T., M.Kom.',
            'email' => 'djoko.jalin@ub.ac.id',
            'password' => Hash::make('123psi'),
        ]);
        DB::table('users')->insert([
            'name' => 'Andi Reza Perdanakusuma, S.Kom., M.MT.',
            'email' => 'andireza@ub.ac.id',
            'password' => Hash::make('123tkti'),
        ]);
        DB::table('users')->insert([
            'name' => 'Alfi Nur Rusydi, S.Si., M.Sc.',
            'email' => 'alfi.nurrusydi@ub.ac.id',
            'password' => Hash::make('123sig'),
        ]);
    }
}
