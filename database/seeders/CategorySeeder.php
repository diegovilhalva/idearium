<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('categories')->insert([
            ['name' => 'Tecnologia', 'slug' => 'tecnologia'],
            ['name' => 'Negócios', 'slug' => 'negocios'],
            ['name' => 'Entretenimento', 'slug' => 'entretenimento'],
            ['name' => 'Saúde', 'slug' => 'saude'],
            ['name' => 'Educação', 'slug' => 'educacao'],
            ['name' => 'Cultura', 'slug' => 'cultura'],
            ['name' => 'Esportes', 'slug' => 'esportes'],
            ['name' => 'Política', 'slug' => 'politica'],
            ['name' => 'Tudo', 'slug' => 'tudo']
        ]);
    }
}
