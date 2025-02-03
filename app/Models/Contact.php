<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';
    protected $primaryKey = 'id';
    protected $fillable = [
        'firstname',
        'lastname',
        'birthday',
        'gender_id',
        'relative_id',
        'user_id'
    ];

    public function gender(){
        return $this->belongsTo(Gender::class);
    }

    public function relative(){
        return $this->belongsTo(Relative::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
