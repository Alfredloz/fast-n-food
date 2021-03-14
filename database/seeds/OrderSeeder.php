<?php

use App\Order;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // 5 fake orders for user with id 1
        for ($i=0; $i < 5; $i++) { 
            $newOrder = new Order();
            $newOrder->user_id = 1;
            $newOrder->total_price = $faker->randomFloat(2, 1, 100);
            $newOrder->save();
        }
    }
}
