<?php

namespace App\Http\Resources;

use App\Models\City;
use App\Models\Country;
use App\Models\Gender;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeadsResource extends JsonResource
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
            'leadnumber'=>$this->leadnumber,
            'firstname'=>$this->firstname,
            'lastname'=>$this->lastname,
            'gender_id'=>$this->gender_id,
            'age'=>$this->age,
            'email'=>$this->email,
            'country_id'=>$this->country_id,
            'city_id'=>$this->city_id,
            'user_id'=>$this->user_id,
            'converted'=>$this->converted,
            'student_id'=>$this->student_id,
            'created_at'=>$this->created_at->format('d m Y'),
            'updated_at'=>$this->updated_at->format('d m Y'),
            'gender'=>Gender::where('id',$this->gender_id)->select('id','name')->first(),
            'country'=>Country::where('id',$this->country_id)->select('id','name')->first(),
            'city'=>City::where('id',$this->city_id)->select('id','name')->first(),
            'user'=>User::where('id',$this->user_id)->select('id','name')->first(),
        ];
    }
}
