<?php

use App\Typology;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;
class TypologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $typologies = config('typologies');
        foreach ($typologies as $typology) {
            $newCategory = new Typology();
            $newCategory->name = $typology['name'];
            $newCategory->img = $typology['img'];
            $newCategory->save();
        }
        
    }
}
