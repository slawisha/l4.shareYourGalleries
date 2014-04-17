<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {

    public function run()
    {
    	//User::truncate();

    	$user= new User;
    	$user->username = 'admin';
    	$user->email = 'slawisha@yahoo.com';
    	$user->password = Hash::make('admin');
    	$user->role_id = 1;
    	$user->save(); 

        $faker = Faker::create();

        foreach(range(2, 10) as $index)
        {

            User::create([
            	'username' => $faker->username,
            	'email' => $faker->email,
            	'password' => Hash::make('1234'),
            	'role_id' => 2
            ]);
        }
    }

}