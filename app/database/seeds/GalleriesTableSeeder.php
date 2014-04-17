<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class GalleriesTableSeeder extends Seeder {

    public function run()
    {
    	Gallery::truncate();
    	
        $faker = Faker::create();

        $user = User::all();

        foreach(range(1, 10) as $index)
        {
        	$name = $faker->words(3);

            Gallery::create([
            	'name' => $name,
            	'description' => $faker->sentences(5),
            	'user_id' => $faker->randomElement($user->id),
            	'rating' => rand(0,6),
            	'url' => public_path() . '/galleries/' . $user->username . '/' . $name
            ]);
        }
    }

}