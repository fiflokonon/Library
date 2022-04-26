<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EntitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('entities')->insert([
            "name" => "IFRI",
        ]);
        DB::table('entities')->insert([
            "name" => "EPAC",
        ]);
        DB::table('entities')->insert([
            "name" => "ENEAM",
        ]);
        DB::table('entities')->insert([
            "name" => "ENAM",
        ]);
        DB::table('entities')->insert([
            "name" => "INE",
        ]);
        DB::table('entities')->insert([
            "name" => "FAST",
        ]);
        DB::table('entities')->insert([
            "name" => "FASEG",
        ]);
    }
}
