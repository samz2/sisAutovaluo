<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('user')->insert([
            'id'=>"admin",
            'user' => "admin",
            'password' => bcrypt("admin"),
            'tipo' => 1,
            'estado'=>1
        ]);
    }
}
