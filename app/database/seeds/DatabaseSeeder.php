<?php

class DatabaseSeeder extends Seeder {

	/**
	 * @var array
	 */
	private $tables = ['users', 'roles', 'galleries', 'images', 'tags', 'user_shares'];

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->cleanDatabase();
		
		Eloquent::unguard();

		$this->call('RolesTableSeeder');

		if( App::environment('development') )
		{
			$this->call('UsersTableSeeder');
			$this->call('UserSharesTableSeeder');
		}
		else 
		{
			$this->call('AdminTableSeeder');
		}

	}

	/**
	 * truncate all databases
	 * @return void 
	 */
	private function cleanDatabase()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0'); //to be able to truncate table with foreign key contraints
		foreach ($this->tables as $table) 
		{
			DB::table($table)->truncate();	
		}
		DB::statement('SET FOREIGN_KEY_CHECKS=1');
	}

}