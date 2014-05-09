<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('RolesTableSeeder');

		if( App::environment == 'production' )
		{
			$this->call('UsersTableSeeder');
			$this->call('UserSharesTableSeeder');
		}
		else 
		{
			$this->call('AdminTableSeeder');
		}

	}

}