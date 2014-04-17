<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ImagesTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        $galleries = Gallery::all();

        foreach ($galleries as $gallery)
        {
        	foreach(range(1, rand(1,11)) as $index)
        		{	
		            Image::create([
		            	
		            ]);
       			}
        }

        
    }

}