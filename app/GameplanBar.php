<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameplanBar extends Model
{
    protected $table = 'gameplanbars';
    public function gameplan(){
        return $this->belongsTo(Gameplan::class, 'id');

    }

    public function bar(){
        return $this->belongsTo(Bar::class, 'id');

    }
}
