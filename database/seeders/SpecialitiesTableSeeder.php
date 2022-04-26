<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('specialities')->insert([
            "name" => "Génie-Logiciel",
            "entity_id" => "1",
        ]);
        DB::table('specialities')->insert([
            "name" => "Sécurité Informatique",
            "entity_id" => "1",
        ]);
        DB::table('specialities')->insert([
            "name" => "Internet et Multimédia",
            "entity_id" => "1",
        ]);
        DB::table('specialities')->insert([
            "name" => "SI-Maintenance Biomédicale",
            "entity_id" => "2",
        ]); 
        DB::table('specialities')->insert([
            "name" => "Gestion Transport et Logistique",
            "entity_id" => "3",
        ]);
        DB::table('specialities')->insert([
            "name" => "Assistance de Direction",
            "entity_id" => "4",
        ]); 
        DB::table('specialities')->insert([
            "name" => "Hydrologie",
            "entity_id" => "5",
        ]);
        DB::table('specialities')->insert([
            "name" => "Mathématique et Informatique Appliquée",
            "entity_id" => "6",
        ]);
        DB::table('specialities')->insert([
            "name" => "Economie Agricole",
            "entity_id" => "7",
        ]);
    }
}
