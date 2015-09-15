<?php

class GroupsSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		try
		{
			// Create the group
			$group = Sentry::createGroup(array(
				'name'        => 'Client',
				'permissions' => array(
					'view' => 1,
				),
			));
			$group = Sentry::createGroup(array(
				'name'        => 'Manager',
				'permissions' => array(
					'add'		=> 1,
					'modify'	=> 1,
					'remove'	=> 1,
					'view'		=> 1,
				),
			));
		} catch(Cartalyst\Sentry\Groups\NameRequiredException $e) {
			echo 'Name field is required';
		} catch(Cartalyst\Sentry\Groups\GroupExistsException $e) {
			echo 'Group already exists';
		}
	}

}