<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'id'                =>  $this->id,
            // 'parent_id'         =>  $this->parent_id,
            'name'              =>  $this->name,
            'slug'              =>  $this->slug,
            'image'             =>  $this->image,
            'is_featured'       =>  $this->is_featured,
            // relations
            // 'seo'               =>  new SeoResource($this->seo),
        ];
    }
}
