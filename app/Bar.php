<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bar extends Model
{
    protected $table = 'bars';

    public static $rules =
    [
    'name' => 'required|max:50',
    'type' => 'required|max:255',
    'address' => 'required|max:255',
    'email' => 'email|max:244|unique:users',
    'phone' => 'min:7|max:10',
    ];

    public function events(){
        return $this->hasMany(Event::class, 'bar_id');

    }

    public function specials(){
        return $this->hasMany(Special::class, 'bar_id');

    }

    public function pictures(){
        return $this->hasMany(Picture::class, 'bar_id');

    }

    public function features(){
        return $this->hasMany(Feature::class, 'bar_id');

    }

    public function reviews(){
        return $this->hasMany(Review::class, 'bar_id');

    }

    public function getDistance($userLat, $userLon, $barLat, $barLon) 
    {
//      earth radius in miles
        $earth_radius = 3960;

        $dLat = deg2rad($barLat - $userLat);
        $dLon = deg2rad($barLon - $userLon);

        $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($userLat)) * cos(deg2rad($barLat)) * sin($dLon/2) * sin($dLon/2);
        $c = 2 * asin(sqrt($a));
        $distance = $earth_radius * $c;

        return $distance;
    }

    public function averageBarRating() 
    {
        $addedRatings = 0;
        $averageRating = 0;
        // need to foreach through all bar's reviews
        foreach ($this->reviews as $review) {
            // call on the attributes array in the review object to get beer rating and add them
            $addedRatings += $review->attributes['beer_rating'];
        }
        // finally some simple math :)
        $averageRating = ($addedRatings / count($this->reviews));
        return round($averageRating);
    }

    public function formatPhoneNumber() 
    {
        $formatNumber = '';
        if(strlen($this->phone) == 7) {
            $formatNumber = substr($this->phone, 0, 3) . '-' . substr($this->phone, 3);
        } elseif(strlen($this->phone) == 10) {
            $formatNumber = '(' . substr($this->phone, 0, 3) . ') ' . substr($this->phone, 3, 3) . '-' . substr(($this->phone), 6);
        }
        return $formatNumber;
    }
}
