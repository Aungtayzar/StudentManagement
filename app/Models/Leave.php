<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;
    protected $table = 'leaves';
    protected $primaryKey = 'id';
    protected $fillable = [
        'post_id',
        'startdate',
        'enddate',
        'tag',
        'title',
        'content',
        'stage_id',
        'authorized_id',
        'user_id'
    ];

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }


    public function stage(){
        return $this->belongsTo(Stage::class);
    }

    public function tag(){
        return $this->belongsTo(User::class);
    }

}
