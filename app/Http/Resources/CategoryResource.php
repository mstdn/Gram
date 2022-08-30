<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class CategoryResource extends JsonResource
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
            'slug'      =>  $this->slug,
            'count'     =>  $this->posts->count(),
            'can'       =>  [
                'create'    =>  Auth::user() ? Auth::user()->can('create-category', $this->resource) : null,
                'delete'    =>  Auth::user() ? Auth::user()->can('delete-category', $this->resource) : null
            ]
        ];
    }
}
