<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FlagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('flags')->insert(
            [
                ['name' => "операция проведена"],
                ['name' => "отказ"],
                ['name' => "в процессе"],
            ]
        );
    }
}
