<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bar extends Model
{
    protected $table = 'bars';

    public static $rules =
        [
            'name' => 'required|max:50',
            'type' => 'required|max:255',
            'address' => 'required|max:255',
            'email' => 'email|max:244|unique:users',
            'phone' => 'min:7|max:10',
        ];

    public function events()
    {
        return $this->hasMany(Event::class, 'bar_id');

    }

    public function specials()
    {
        return $this->hasMany(Special::class, 'bar_id');

    }

    public function pictures()
    {
        return $this->hasMany(Picture::class, 'bar_id');

    }

    public function features()
    {
        return $this->hasMany(Feature::class, 'bar_id');

    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'bar_id');

    }

    public function getDistance($userLat, $userLon, $barLat, $barLon)
    {
//      earth radius in miles
        $earth_radius = 3960;

        $dLat = deg2rad($barLat - $userLat);
        $dLon = deg2rad($barLon - $userLon);

        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($userLat)) * cos(deg2rad($barLat)) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * asin(sqrt($a));
        $distance = $earth_radius * $c;

        return $distance;
    }

    public static function searchBy($searchTerm, $features)
    {
        $query = static::join('bar_features', 'bar_features.bar_id', '=', 'bars.id')->where('bars.name', 'LIKE', "%$searchTerm%");
        if ($features[0] != '') {
            foreach ($features as $key => $feature) {
                $query = $query->where("bar_features.$feature", '=', 1);
            }
        }
        return $query;
    }


    public static function recentBarsSpecialsEvents()
    {
        //change limit to increase results
        // infinite scroll??
        $bars = Bar::limit(10)->orderBy('created_at', 'desc')->get();
        $events = Event::limit(10)->orderBy('created_at', 'desc')->get();
        $specials = Special::limit(10)->orderBy('created_at', 'desc')->get();
        $recent['bars'] = $bars;
        $recent['events'] = $events;
        $recent['specials'] = $specials;
        return $recent;
    }

    public function averageBarRating()
    {
//        $addedRatings = 0;
//        $averageRating = 0;
        // need to foreach through all bar's reviews
//        dd($this->reviews);
//        if (sizeof($this->reviews) > 0) {
            // added so bar page doesnt break on creation because of division by 0
//            foreach ($this->reviews as $review) {
//                // call on the attributes array in the review object to get beer rating and add them
//                $addedRatings += $review->attributes['beer_rating'];
//            }
//            // finally some simple math :)
//            $averageRating = ($addedRatings / count($this->reviews));
            $averageRating = round($this->beerRating());
//        }
        // i think this is the same
        // $this->reviews->avg('beer_rating');
        // not sure how to test
        // it works
        // made function for beer rating
        switch ($averageRating) {
            // cant decide to use unicode characters with css styling or stick to <i> tags
            case 0:
                $starRating = '';
                break;
            case 1:
                $starRating = '<i class="fa fa-star" aria-hidden="true"></i>';
                break;
            case 2:
                $starRating = '&#xf005;&#xf005;';
                break;
            case 3:
                $starRating = '&#xf005;&#xf005;&#xf005;';
                break;
            case 4:
                $starRating = '&#xf005;&#xf005;&#xf005;&#xf005;';
                break;
            case 5:
                $starRating = '&#xf005;&#xf005;&#xf005;&#xf005;&#xf005;';
                break;
        }
        return $starRating;
    }

    public function beerRating()
    {
        return $this->reviews()->avg('beer_rating');
    }

    public function formatPhoneNumber()
    {
        $formatNumber = '';
        if (strlen($this->phone) == 7) {
            $formatNumber = substr($this->phone, 0, 3) . '-' . substr($this->phone, 3);
        } elseif (strlen($this->phone) == 10) {
            $formatNumber = '(' . substr($this->phone, 0, 3) . ') ' . substr($this->phone, 3, 3) . '-' . substr(($this->phone), 6);
        }
        return $formatNumber;
    }
    public static function highestRated()
    {
        return static::orderBy('beer_rating', 'desc');
    }
}
