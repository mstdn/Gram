<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class FollowerResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'            =>  $this->id,
            'name'          =>  $this->name,
            'username'      =>  $this->username,
            'about'         =>  $this->about,
            'time'          =>  $this->created_at->diffForHumans(),
            'avatar'        =>  $this->getProfilePhotoUrlAttribute(),
            'followers'     =>  $this->followers()->count(),
            'followings'    =>  $this->followings()->count(),
            'postcount'     =>  $this->posts->count(),
            'is'            => [
                'following'     =>  Auth::user() ? Auth::user()->isFollowing($this->resource) : null,
                'self'          =>  Auth::user() ? Auth::user()->is($this->resource) : null
            ]
        ];
    }
}
