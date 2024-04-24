<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photop extends Model
{
    use HasFactory;
    protected $fillable=['photo','place_id'];

    public function place()
    {
        return $this->belongsTo('App\Models\Place','place_id');
    }
}
