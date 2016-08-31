<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Special extends Model
{
    protected $table = 'specials';

	public static $rules =
		[
			'title' => 'required|max:255',
			'content' => 'required|max:255'
		];

    public function bar(){
        return $this->belongsTo(Bar::class);

    }
}
