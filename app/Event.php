<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

	public static $rules =
		[
			'title' => 'required|max:50',
			'date' => 'required|max:10',
			'content' => 'required|max:255'
		];

    public function user(){
        return $this->belongsTo(User::class);

    }

    public function bar(){
        return $this->belongsTo(Bar::class);

    }
}
