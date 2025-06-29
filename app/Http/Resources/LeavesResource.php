<?php

namespace App\Http\Resources;

use App\Models\Post;
use App\Models\Stage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeavesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'post_id'=>$this->post_id,
            'startdate'=>$this->startdate,
            'enddate'=>$this->enddate,
            'tag'=>$this->tag,
            'title'=>$this->title,
            'content'=>$this->content,
            'stage_id'=>$this->stage_id,
            'authorized_id'=>$this->authorized_id,
            'user_id'=>$this->user_id,
            'created_at'=>$this->created_at->format('d m Y'),
            'updated_at'=>$this->updated_at->format('d m Y'),
            'user'=>User::where('id',$this->user_id)->select('id','name')->first(),
            'post'=>Post::where('id',$this->post_id)->select('id','title')->first(),
            'stage'=>Stage::where('id',$this->stage_id)->select('id','name')->first(),

        ];
    }
}
