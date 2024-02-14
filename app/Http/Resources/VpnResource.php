<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VpnResource extends JsonResource
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
            'country' => $this->country,
            'city' => $this->city,
            'file' => $this->file_url
        ];
    }
}
