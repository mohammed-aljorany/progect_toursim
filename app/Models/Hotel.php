<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    protected $fillable=['hotel_name','info','number_room','photo','number_rate','city_id','country_id'];

    public function city()
    {
        return $this->belongsTo('App\Models\City','city_id');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Country','country_id');
    }
}
