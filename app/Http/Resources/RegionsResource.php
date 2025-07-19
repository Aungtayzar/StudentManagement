<?php

namespace App\Http\Resources;

use App\Models\Country;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RegionsResource extends JsonResource
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
                    'name'=>$this->name,
                    'slug'=>$this->slug,
                    'created_at'=>$this->created_at->format('d m Y'),
                    'updated_at'=>$this->updated_at->format('d m Y'),
                    'country_id'=>Country::where('id',$this->country_id)->select('id','name')->first(),
                    'status'=>Status::where('id',$this->status_id)->select('id','name')->first(),
                    'user'=>User::where('id',$this->user_id)->select('id','name')->first(),
                  ];
    }
}
