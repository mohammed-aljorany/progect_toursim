<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamousPlace extends Model
{
    use HasFactory;
    protected $fillable=['name','info', 'country_id','city_id' ];

    public function country()
    {
        return $this->belongsTo('App\Models\Country','country_id');
    }


    public function city(){
        return $this->belongsTo('App\Models\City','city_id');
    }

    public function photo()
    {
        return $this->hasMany('App\Models\Photof','famous_place_id');
    }
}
