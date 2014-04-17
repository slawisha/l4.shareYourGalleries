<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class UserSharesTableSeeder extends Seeder {

    public function run()
    {
    	//UserShare::truncate();
    	
        $faker = Faker::create();

        $users = User::where('role_id', '!=', 1)->lists('id');

        $userSharePairs = [];

        foreach(range(1, 30) as $index)
        {
        	$userId = $faker->randomElement($users);
        	$userShareId = $faker->randomElement($users);

  			while( $userShareId == $userId) {
  				$userShareId = $faker->randomElement($users);
  			}

  			if(!in_array([$userId,$userShareId], $userSharePairs))
  			{
			 	UserShare::create([
			            	'user_id' => $userId,
			            	'user_share_id' => $userShareId
			            ]);

			    $userSharePairs[] = [$userId, $userShareId];

  			}          
        }
    }

}