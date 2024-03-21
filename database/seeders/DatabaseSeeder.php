<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		\App\Models\User::factory()->create([
			'avatar' => 'avatar/bkCBwHMsuUQ38J0HLCt2K9Nu8mD1tfqTL7ozuRkT.jpg',
			'name' => 'admin',
			'email' => 'admin@gmail.com',
			'password' => '$2y$10$wWle/pwRASHm/r1AgFstMexmbQL6OhCCuLoTAz99W8aJG8aq.jV8O',
			'remember_token' => 'BbkpNJSDcMhebAmK8Ds0u18woX1Qwp8gjdvo1Aw4ufw7wXAHuDjL5UIcy55r',
		]);
		\App\Models\Post::factory(10)->create();
	}
}
