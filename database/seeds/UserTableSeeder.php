<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'BarHive Admin',
            'email' => 'admin@barhive.nl',
            'password' => bcrypt('barhiv3'),
        ]);
    }
}
