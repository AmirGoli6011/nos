<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
	use Sluggable;
	use HasFactory;

	protected $fillable = [
		'user_id',
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
		return $this->hasMany(Comment::class)->orderBy('id','desc');
	}

	public function tags()
	{
		return $this->belongsToMany(Tag::class);
	}
}
