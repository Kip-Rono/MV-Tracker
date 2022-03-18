<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
        ]);

        DB::table('users')->insert([
            'name' => 'john',
            'email' => 'johndoe@gmail.com',
            'password' => bcrypt('john123'),
        ]);

        DB::table('users')->insert([
            'name' => 'jane',
            'email' => 'janedoe@gmail.com',
            'password' => bcrypt('jane123'),
        ]);
    }
}
