<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SeoResource extends JsonResource
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
            'seo_image'         =>  $this->seo_image,
            'seo_title'         =>  $this->seo_title,
            'seo_description'   =>  $this->seo_description,
            'seo_keyword'       =>  $this->seo_keyword,
        ];
    }
}
