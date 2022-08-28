<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'            =>  $this->id,
            'description'   =>  $this->description,
            'time'          =>  $this->created_at->diffForHumans(),
            'file'          =>  '/storage/' . $this->file,    
            'category'      =>  $this->category->name,
            'category_id'   =>  $this->category->id,
            'avatar'        =>  $this->user->getProfilePhotoUrlAttribute(),
            'username'      =>  $this->user->username,
            'name'          =>  $this->user->name
        ];
    }
}
