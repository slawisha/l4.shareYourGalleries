<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class RolesTableSeeder extends Seeder {

    public function run()
    {

        $role = new Role;
        $role->name = 'admin';
        $role->save();

        $role = new Role;
        $role->name = 'member';
        $role->save();
    }

}