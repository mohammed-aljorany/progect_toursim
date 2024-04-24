<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $fillable=['country_name' ,'photo' ,'info'];

    public function famous(){
        return $this->hasMany('App\Models\FamousPlace','country_id');
    }

    public function city(){
        return $this->hasMany('App\Models\City','country_id');
    }

    public function hotel(){
        return $this->hasMany('App\Models\Hotel','country_id');
    }
}
