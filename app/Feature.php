<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $table = 'bar_features';

    private $labels = [
    	'smoking' => 'Smoking allowed',
    	'food' => 'Kitchen',
    	'pet_friendly' => 'Pet friendly',
    	'bikes' => 'Bikes racks',
    	'live_music' => 'Live music',
    	'reservations' => 'Needs reservation',
    	'tvs' => 'Tvs',
    	'18+' => '18+',
    	'kids' => 'Kids allowed',
    	'patio' => 'Outside seating',
    	'pool' => 'Pool tables',
    	'darts' => 'Darts',
    ];

    public function bar()
    {
        return $this->belongsTo(Bar::class, 'bar_id');

    }
    public function featureIcons() 
    {
    	$icons = [];
    	foreach ($this->labels as $feature => $label) {
    		if ($this->attributes[$feature] ==  1) {
    			$icons[] = $label;
    		}
    	}
    	return implode('<br>', $icons);
    }
}
