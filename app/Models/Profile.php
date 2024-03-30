<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Carbon;


class Profile extends Model
{
    use HasFactory;
    protected $fillable=['first_name','last_name', 'photo' ,'gender' ,'country' ,'hoppies', 'birthday','number_phone','user_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function setBirthdayAttribute($value)
    {
        $this->attributes['birthday']=Carbon::createFromFormat('d/m/y',$value);
    }

    public function getBirthdayAttribute()
    {
        $this->attributes['birthday']=Carbon::createFromFormat('d/m/y',$this->attributes['birthday']);
    }

}
