<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'            =>  $this->id,
            'user_id'       =>  $this->user_id,
            'description'   =>  $this->description,
            'time'          =>  $this->created_at->diffForHumans(),
            'file'          =>  '/storage/' . $this->file,    
            'category'      =>  $this->category->name,
            'category_id'   =>  $this->category->id,
            'avatar'        =>  $this->user->getProfilePhotoUrlAttribute(),
            'username'      =>  $this->user->username,
            'name'          =>  $this->user->name,
            'likes'         =>  $this->likers()->count(),
            'replycount'    =>  $this->replies->count(),
            'replies'       =>  ReplyResource::collection($this->whenLoaded('replies')),
            'can'           => [
                'delete'        =>  Auth::user() ? Auth::user()->can('delete-post', $this->resource) : null,
                'liked'         =>  Auth::user() ? Auth::user()->hasLiked($this->resource) : null
            ]
        ];
    }
}
