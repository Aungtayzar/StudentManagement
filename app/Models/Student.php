<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = 'students';
    protected $primaryKey = 'id';
    protected $fillable = [
        'regnumber',
        'firstname',
        'lastname',
        'slug',
        'dob',
        'gender_id',
        'age',
        'email',
        'country_id',
        'region_id',
        'city_id',
        'township_id',
        'address',
        'religion_id',
        'nationalid',
        'remark',
        'status_id',
        'user_id',
    ];

    public function gender(){
        return $this->belongsTo(Gender::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function region(){
        return $this->belongsTo(Region::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function township(){
        return $this->belongsTo(Township::class);
    }

    public function religion(){
        return $this->belongsTo(Religion::class);
    }
    
    public function status(){
        return $this->belongsTo(Status::class);
    }


    public function user(){
        return $this->belongsTo(User::class);
    }
}
