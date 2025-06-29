<?php

namespace App\Http\Resources;

use App\Models\Gender;
use App\Models\Relative;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ContactsCollection extends ResourceCollection
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
                    'firstname'=>$data->firstname,
                    'lastname'=>$data->lastname,
                    'birthday'=>$data->birthday,
                    'gender_id'=>$data->gender_id,
                    'user_id'=>$data->user_id,
                    'relative_id'=>$data->relative_id,
                    'created_at'=>$data->created_at->format('d m Y'),
                    'updated_at'=>$data->updated_at->format('d m Y'),
                    'gender'=>Gender::where('id',$data->gender_id)->select('id','name')->first(),
                    'user'=>User::where('id',$data->user_id)->select('id','name')->first(),
                    'relative_id'=>Relative::where('id',$data->relative_id)->select('id','name')->first(),
                ];
            })
        ];
    }
}
