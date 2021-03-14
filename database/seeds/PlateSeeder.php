<?php

use App\Plate;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class PlateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // Generating 5 fake plates for the user 1
        for ($i=0; $i < 5; $i++) {
            $newPlate = new Plate();
            $newPlate->user_id = 1;
            $newPlate->name = $faker->word(true);
            $newPlate->description_ingredients = $faker->sentence(3, true);
            $newPlate->price = $faker->randomFloat(2, 1, 50);
            $newPlate->slug = Str::slug($newPlate->name . '-' . $newPlate->user_id);
            $newPlate->visibility = $faker->numberBetween(0, 1);
            $newPlate->save();
        }
    }
}
