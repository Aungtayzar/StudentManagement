<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'slug',
        'status_id',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
