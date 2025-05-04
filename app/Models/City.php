<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $table = 'cities';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'slug',
        'region_id',
        'status_id',
        'user_id'
    ];

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function region(){
        return $this->belongsTo(Region::class);
    }



    public function user(){
        return $this->belongsTo(User::class);
    }
}
