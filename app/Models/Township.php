<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Township extends Model
{
    use HasFactory; 
    protected $table = 'townships';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'slug',
        'country_id',
        'region_id',
        'city_id',
        'status_id',
        'user_id'
    ];

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function retgion(){
        return $this->belongsTo(Region::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
