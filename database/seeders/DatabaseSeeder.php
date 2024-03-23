<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
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
		User::factory()->create([
			'avatar' => 'storage/avatar/Goli.png',
			'name' => 'admin',
			'email' => 'admin@gmail.com',
			'password' => '$2y$10$wWle/pwRASHm/r1AgFstMexmbQL6OhCCuLoTAz99W8aJG8aq.jV8O',
			'remember_token' => 'BbkpNJSDcMhebAmK8Ds0u18woX1Qwp8gjdvo1Aw4ufw7wXAHuDjL5UIcy55r',
		]);
		Post::factory(10)->create();
		Tag::factory(10)->create();
	}
}
