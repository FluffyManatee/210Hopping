<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bar extends Model
{
    protected $table = 'bars';

	public static $rules =
		[
			'name' => 'required|max:255',
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

}
