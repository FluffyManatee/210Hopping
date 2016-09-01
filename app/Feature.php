<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $table = 'bar_features';

    public function bar(){
        return $this->belongsTo(Bar::class);

    }
}