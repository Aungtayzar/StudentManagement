<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;
    protected $table = 'leads';
    protected $primaryKey = 'id';
    protected $fillable = [
        'leadnumber',
        'firstname',
        'lastname',
        'gender_id',
        'age',
        'email',
        'country_id',
        'city_id',
        'user_id',
        'converted',
        'student_id'
    ];

    public function gender(){
        return $this->belongsTo(Gender::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }


    public function user(){
        return $this->belongsTo(User::class);
    }
}
