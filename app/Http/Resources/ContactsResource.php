<?php

namespace App\Http\Resources;

use App\Models\Gender;
use App\Models\Relative;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactsResource extends JsonResource
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
            'firstname'=>$this->firstname,
            'lastname'=>$this->lastname,
            'birthday'=>$this->birthday,
            'gender_id'=>$this->gender_id,
            'relative_id'=>$this->relative_id,
            'user_id'=>$this->user_id,
            'created_at'=>$this->created_at->format('d m Y'),
            'updated_at'=>$this->updated_at->format('d m Y'),
            'gender'=>Gender::where('id',$this->gender_id)->select('id','name')->first(),
            'user'=>User::where('id',$this->user_id)->select('id','name')->first(),
            'relative_id'=>Relative::where('id',$this->relative_id)->select('id','name')->first(),
        ];
    }
}
