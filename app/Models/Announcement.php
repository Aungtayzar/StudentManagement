<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $table = 'announcements';
    protected $primaryKey = 'id';
    protected $fillable = [
        'image',
        'title',
        'content',
        'post_id',
        'status_id',
        'user_id'
    ];

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tagposts($postjson){
        $postids  = json_decode($postjson,true); //Decode JSON-encoded tags

        $posts = Post::whereIn('id',$postids)->pluck('title','id');

        return $posts;
    }
}
