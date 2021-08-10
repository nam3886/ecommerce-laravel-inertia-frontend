<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
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
            'image'         =>  $this->image,
            'position'      =>  $this->position,
            'link'          =>  $this->link,
            'title'         =>  $this->title,
            'content'       =>  $this->content,
            // 'order'         =>  $this->order,
            // 'active'        =>  $this->active,
            // 'updated_by'    =>  $this->updated_by,
            // 'updated_at'    =>  $this->updated_at->diffForHumans(),
            // 'deleted_at'    =>  $this->deleted_at?->diffForHumans(),
        ];
    }
}
