<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AttributeResource extends JsonResource
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
            // 'frontend_type' =>  $this->frontend_type,
            // 'is_filterable' =>  $this->is_filterable,
            // 'is_required'   =>  $this->is_required,
            // 'active'        =>  $this->active,
            // 'updated_by'    =>  $this->updated_by,
            // 'updated_at'    =>  $this->updated_at->diffForHumans(),
            // 'deleted_at'    =>  $this->deleted_at?->diffForHumans(),
            // 'values'        =>   AttributeValueResource::collection($this->values),
        ];
    }
}
