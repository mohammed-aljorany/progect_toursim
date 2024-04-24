<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable=['city_name','info','photo','country_id'];

    public function country()
    {
        return $this->belongsTo('App\Model\Country','country_id');
    }

    public function famous(){
        return $this->hasMany('App\Models\FamousPlace','city_id');
    }

    public function hotel()
    {
        return $this->hasMany('App\Models\Hotel','city_id');
    }
}
