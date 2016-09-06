<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hopper extends Model
{
    protected $table = 'hoppers';

    public function gameplan(){
        return $this->belongsTo(Gameplan::class, 'id');

    }

    public function user(){
        return $this->belongsTo(User::class, 'hopper_id');

    }
}
