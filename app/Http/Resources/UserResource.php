<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\Auth;
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
            'id'            =>  $this->id,
            'name'          =>  $this->name,
            'username'      =>  $this->username,
            'about'         =>  $this->about,
            'time'          =>  $this->created_at,
            'avatar'        =>  $this->getProfilePhotoUrlAttribute(),
            'followers'     =>  $this->followers()->count(),
            'followings'    =>  $this->followings()->count(),
            'posts'         =>  PostResource::collection($this->posts),
            'postcount'     =>  $this->posts->count(),
            'is'           => [
                'following'     =>  Auth::user() ? Auth::user()->isFollowing($this->resource) : null,
                'self'          => Auth::user() ? Auth::user()->is($this->resource) : null
            ]
        ];
    }
}
