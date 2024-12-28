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


    public function maptagtonames($users=null){
        
       $tagids = json_decode($this->tag,true);
       $tagnames = collect($tagids)->map(function($id) use ($users){
        return $users[$id] ?? 'Unknow';
       });
    

      return $tagnames->join(', ');
    }

    public function tagpersons($tagjson){
        $tagids  = json_decode($tagjson,true); //Decode JSON-encoded tags

        $tags = User::whereIn('id',$tagids)->pluck('name','id');

        return $tags;
    }

    public function tagposts($postjson){
        $postids  = json_decode($postjson,true); //Decode JSON-encoded tags

        $posts = Post::whereIn('id',$postids)->pluck('title','id');

        return $posts;
    }

    public function isconverted(){
        return $this->stage_id != 2; //2
    }

}
