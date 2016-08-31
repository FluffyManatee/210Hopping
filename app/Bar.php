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
			'email' => 'required|email|max:244|unique:users',
			'password' => 'required|min:6'
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

    public function getDistance($userLat, $userLon, $barLat, $barLon) {
//      earth radius in miles
        $earth_radius = 3960;

        $dLat = deg2rad($barLat - $userLat);
        $dLon = deg2rad($barLon - $userLon);

        $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($userLat)) * cos(deg2rad($barLat)) * sin($dLon/2) * sin($dLon/2);
        $c = 2 * asin(sqrt($a));
        $distance = $earth_radius * $c;

        return $distance;
    }

}
