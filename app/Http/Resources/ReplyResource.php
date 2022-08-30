<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReplyResource extends JsonResource
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
            'id'        =>  $this->id,
            'reply'     =>  $this->reply,
            'time'      =>  $this->created_at->diffForHumans(),
            'avatar'    =>  $this->user->getProfilePhotoUrlAttribute(),
            'username'  =>  $this->user->username,
            'user_id'   =>  $this->user->id,
            'name'      =>  $this->user->name
        ];
    }
}
