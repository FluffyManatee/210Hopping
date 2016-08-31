<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';

	public static $rules =
		[
			'title' => 'required|max:50',
			'content' => 'required|max:255',
			'beer_rating' => 'required',
		];

    public function votes(){
        return $this->hasMany(Vote::class, 'review_id');

    }
    public function user(){
        return $this->belongsTo(User::class);

    }
    public function bar(){
        return $this->belongsTo(Bar::class);

    }
}
