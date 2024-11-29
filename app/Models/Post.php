<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $primaryKey = 'id';
    protected $fillable = [
        'image',
        'title',
        'slug',
        'content',
        'fee',
        'startdate',
        'enddate',
        'starttime',
        'endtime',
        'type_id',
        'tag_id',
        'attshow',
        'status_id',
        'user_id'
    ];

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function attshow(){
        return $this->belongsTo(Status::class);
    }

    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function tag(){
        return $this->belongsTo(Tag::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
