<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photof extends Model
{
    use HasFactory;
    protected $fillable=['photo','famous_place_id'];

    public function famous()
    {
        return $this->belongsTo('App\Model\FamousPlace','famous_place_id');
    }
}
