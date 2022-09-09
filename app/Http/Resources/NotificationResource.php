<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'            =>  $this->id,
            'created_at'    =>  $this->created_at->diffForHumans(),
            'type'          =>  $this->notifiable_type,
            'read_at'       =>  $this->read_at->diffForHumans(),
            //'post'          =>  PostResource::make($this->post),
            'user'          =>  UserResource::make($this->resource)
        ];
    }
}
