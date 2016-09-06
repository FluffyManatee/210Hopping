<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gameplan extends Model
{
    protected $table = 'gameplans';

    public function hoppers(){
        return $this->hasMany(Hopper::class, 'gameplan_id');

    }


    public function author(){
        return $this->belongsTo(User::class, 'id');

    }

    public function bars(){
        return $this->hasMany(GameplanBar::class, 'gameplan_id');

    }
}
