<?php

namespace App\Http\Resources;

use App\Models\City;
use App\Models\Country;
use App\Models\Gender;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class LeadsCollection extends ResourceCollection
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
                    'leadnumber'=>$data->leadnumber,
                    'firstname'=>$data->firstname,
                    'lastname'=>$data->lastname,
                    'gender_id'=>$data->gender_id,
                    'age'=>$data->age,
                    'email'=>$data->email,
                    'country_id'=>$data->country_id,
                    'city_id'=>$data->city_id,
                    'user_id'=>$data->user_id,
                    'converted'=>$data->converted,
                    'student_id'=>$data->student_id,
                    'created_at'=>$data->created_at->format('d m Y'),
                    'updated_at'=>$data->updated_at->format('d m Y'),
                    'gender'=>Gender::where('id',$data->gender_id)->select('id','name')->first(),
                    'country'=>Country::where('id',$data->country_id)->select('id','name')->first(),
                    'city'=>City::where('id',$data->city_id)->select('id','name')->first(),
                    'user'=>User::where('id',$data->user_id)->select('id','name')->first(),
                ];
            })
        ];
    }
}
