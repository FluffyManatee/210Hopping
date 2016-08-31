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
        return $this->belongsTo(User::class, 'created_by');

    }
    public function bar(){
        return $this->belongsTo(Bar::class);

    }
    public function beerRating()
    {
        $rating = $this->beer_rating;
        $starRating = '';
        switch ($rating) {
            case 0:
            $starRating = '';
            break;
            case 1:
            $starRating = '*';
            break;
            case 2:
            $starRating = '**';
            break;
            case 3:
            $starRating = '***';
            break;
            case 4:
            $starRating = '****';
            break;
            case 5:
            $starRating = '*****';
            break;
        }
        return $starRating;
    }
}
