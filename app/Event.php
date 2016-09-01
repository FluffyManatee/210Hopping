<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    protected $table = 'events';

	public static function orderDesc($item) {
		return  Event::with('user')->orderBy('created_at', 'desc')->paginate($item);
	}

	public function getDateAttribute($value) {
		$utc = Carbon::createFromFormat("Y-m-d", $value);
		return $utc->setTimezone('America/Chicago');
	}

	public static $rules =
		[
			'title' => 'required|max:255',
			'date' => 'required|max:10',
			'content' => 'required|max:255'
		];

    public function user(){
        return $this->belongsTo(User::class, 'created_by');

    }

    public function bar(){
        return $this->belongsTo(Bar::class, 'bar_id');

    }
}
