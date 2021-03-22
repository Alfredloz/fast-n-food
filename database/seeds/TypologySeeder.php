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
        DB::table('typologies')->insert([
            'name' => 'pancake',
            'img' => '/images/typologies/001-pancake.png'
        ]);
        DB::table('typologies')->insert([
            'name' => 'pizza',
            'img' => '/images/typologies/007-pancake.png'
        ]);
    }
}
