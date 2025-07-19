<?php

namespace App\Http\Resources;

use App\Models\City;
use App\Models\Country;
use App\Models\Region;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TownshipsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "data"=>$this->collection->transform(function($data){
                return [
                    'id'=>$data->id,
                    'name'=>$data->name,
                    'slug'=>$data->slug,
                    'created_at'=>$data->created_at->format('d m Y'),
                    'updated_at'=>$data->updated_at->format('d m Y'),
                    'region_id'=>Region::where('id',$data->region_id)->select('id','name')->first(),
                    'city_id'=>City::where('id',$data->city_id)->select('id','name')->first(),
                    'country_id'=>Country::where('id',$data->country_id)->select('id','name')->first(),
                    'status'=>Status::where('id',$data->status_id)->select('id','name')->first(),
                    'user'=>User::where('id',$data->user_id)->select('id','name')->first(),
                ];

            })
        ];
    }
}
