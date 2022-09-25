<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class SkillResource extends JsonResource
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
            'course_id' => $this->course_id,
            'level_id' => $this->level_id,
            'price' => $this->price,
            'level_number' => $this->level->number,
            'level_roman' => $this->level->roman,
            'course_name' => $this->course->name,
            'status' => $this->status,
        ];
    }
}
