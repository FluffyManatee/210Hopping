<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    public function user(){
        return $this->belongsTo(User::class);

    }

    public function bar(){
        return $this->belongsTo(Bar::class);

    }
}
