<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AttributeValueResource extends JsonResource
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
            'code'          =>  $this->code,
            // 'attribute_id'  =>  $this->attribute_id,
            // 'active'        =>  $this->active,
            // 'updated_by'    =>  $this->updated_by,
            // 'updated_at'    =>  $this->updated_at->diffForHumans(),
            // 'deleted_at'    =>  $this->deleted_at?->diffForHumans(),
            // relations
            // 'attribute'     =>  new AttributeResource($this->attribute),
        ];
    }
}
