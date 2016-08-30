<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Special extends Model
{
    protected $table = 'specials';

    public function bar(){
        return $this->belongsTo(Bar::class);

    }
}
