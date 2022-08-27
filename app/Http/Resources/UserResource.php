<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name'      =>  $this->name,
            'username'  =>  $this->username,
            'about'     =>  $this->about,
            'time'      =>  $this->created_at,
            'avatar'    =>  $this->getProfilePhotoUrlAttribute(),
            'posts'     =>  PostResource::collection($this->posts)
        ];
    }
}
