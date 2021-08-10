<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            =>  $this->id,
            'name'          =>  $this->name,
            'slug'          =>  $this->slug,
            'link'          =>  $this->link,
            'image'         =>  $this->image,
            'description'   =>  $this->description,
            'content'       =>  $this->content,
            // 'order'         =>  $this->order,
            // 'active'        =>  $this->active,
            // 'updated_by'    =>  $this->updated_by,
            // 'updated_at'    =>  $this->updated_at->diffForHumans(),
            // 'deleted_at'    =>  $this->deleted_at?->diffForHumans(),
        ];
    }
}
