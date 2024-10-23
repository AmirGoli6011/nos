<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Category;
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
			'avatar' => 'avatars/admin.png',
			'name' => 'admin',
			'username' => 'admin',
			'email' => 'admin@gmail.com',
			'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
			'remember_token' => 'BbkpNJSDcMhebAmK8Ds0u18woX1Qwp8gjdvo1Aw4ufw7wXAHuDjL5UIcy55r',
		]);
		User::factory(100)->create();
		Post::factory(100)->create();
		Category::factory(50)->create();
	}
}
