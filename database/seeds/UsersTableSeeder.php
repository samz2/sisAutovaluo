<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert([
            'id' => 'admin',
            'user' => 'admin',
            'password' => bcrypt('admin'),
            'tipo' => 1,
            'estado' => 1
        ]);

        DB::table('user')->insert([
            'id' => '70370572',
            'user' => '70370572',
            'password' => bcrypt('70370572'),
            'tipo' => 2,
            'estado' => 1
        ]);

        DB::table('user')->insert([
            'id' => '72162124',
            'user' => '72162124',
            'password' => bcrypt('72162124'),
            'tipo' => 3,
            'estado' => 1
        ]);

        DB::table('user')->insert([
            'id' => '74647666',
            'user' => '74647666',
            'password' => bcrypt('74647666'),
            'tipo' => 3,
            'estado' => 1
        ]);
    }
}
