<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Overtrue\LaravelFavorite\Traits\Favoriteable;

class Post extends Model
{
	use Sluggable, HasFactory, Favoriteable;

	protected $fillable = [
		'user_id',
		'dir',
		'image',
		'title',
		'slug',
		'body'
	];


	/**
	 * Return the sluggable configuration array for this model.
	 *
	 * @return array
	 */
	public function sluggable(): array
	{
		return [
			'slug' => [
				'source' => 'title'
			]
		];
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function comments()
	{
		return $this->hasMany(Comment::class)->orderBy('id', 'desc');
	}

	public function tags()
	{
		return $this->belongsToMany(Tag::class);
	}
}
