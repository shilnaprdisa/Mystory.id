<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'skill_id' => $this->skill_id,
            'course' => $this->course,
            'level' => $this->level,
            'roman' => $this->roman,
            'price' => $this->price,
            'time' => $this->time,
            'admin_fee' => $this->admin_fee,
            'total_price' => $this->total_price,
            'status' => $this->status,
            'payment_code' => $this->payment_code,
            'customer_name' => $this->user->name,
            'customer_phone' => $this->user->country_code.$this->user->phone,
            'tentor_name' => $this->skill->user->name,
            'tentor_phone' => $this->skill->user->country_code.$this->skill->user->phone,
            'created_at' => $this->created_at
        ];
    }
}
