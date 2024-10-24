<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateARelBetweenPostsAndCategories extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('category_post', function (Blueprint $table) {
			$table->id();
			$table->foreignId('post_id')
				->references('id')
				->on('posts')
				->onDelete('cascade');
			$table->foreignId('category_id')
				->references('id')
				->on('categories')
				->onDelete('cascade');
			$table->unique(['post_id','category_id']);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('category_post');
	}
}
