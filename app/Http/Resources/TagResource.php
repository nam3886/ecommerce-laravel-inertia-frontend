<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
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
            'name'                          =>  $this->name,
            'slug'                          =>  $this->slug,
            // 'updated_by'                    =>  $this->updated_by,
            // 'updated_at'                    =>  $this->updated_at->diffForHumans(),
            // 'deleted_at'                    =>  $this->deleted_at?->diffForHumans(),
            // 'active'                        =>  $this->active,
        ];
    }
}
