<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Default table
        DB::table('tables')->insert([
            'iTableId' => -1,
            'sCurrentStatus' => 'empty',
            'iSaved' => 1,
        ]);

        // Insert settings
        DB::table('settings')->insert([
            'setting' => 'dontOrderOnTable',
            'value' => 0,
        ]);
        DB::table('settings')->insert([
            'setting' => 'quickOrder',
            'value' => 0,
        ]);
        DB::table('settings')->insert([
            'setting' => 'curr',
            'value' => 0,
        ]);
    }
}
