<?php

namespace App\Http\Resources;

use App\Models\Post;
use App\Models\Stage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class LeavesCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data'=>$this->collection->transform(function($data){
                return [
                    'id'=>$data->id,
                    'post_id'=>$data->post_id,
                    'startdate'=>$data->startdate,
                    'enddate'=>$data->enddate,
                    'tag'=>$data->tag,
                    'title'=>$data->title,
                    'content'=>$data->content,
                    'stage_id'=>$data->stage_id,
                    'authorized_id'=>$data->authorized_id,
                    'user_id'=>$data->user_id,
                    'created_at'=>$data->created_at->format('d m Y'),
                    'updated_at'=>$data->updated_at->format('d m Y'),
                    'user'=>User::where('id',$data->user_id)->select('id','name')->first(),
                    'post'=>Post::where('id',$data->post_id)->select('id','name')->first(),
                    'stage'=>Stage::where('id',$data->stage_id)->select('id','name')->first(),
                ];
            })
        ];
    }
}
