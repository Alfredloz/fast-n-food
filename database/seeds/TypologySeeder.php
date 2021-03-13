<?php

use App\Typology;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class TypologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 20; $i++) { 
            $newTypology = new Typology();
            $newTypology->name = $faker->unique()->word();
            $newTypology->save();
        }
    }
}
