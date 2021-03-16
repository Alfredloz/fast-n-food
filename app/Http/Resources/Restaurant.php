<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Restaurant extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return only the restaurant informations
        return [
            'id' => $this->id,
            'restaurant_name' => $this->restaurant_name,
            'restaurant_description' => $this->restaurant_description,
            'restaurant_logo' => $this->restaurant_logo,
            'restaurant_banner' => $this->restaurant_banner,
            'address' => $this->address,
            'phone_number' => $this->phone_number,
            'slug' => $this->slug,
            'typologies' => $this->typologies
        ];
    }
}
