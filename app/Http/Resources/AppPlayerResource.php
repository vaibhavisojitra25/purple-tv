<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppPlayerResource extends JsonResource
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
            'live_tv' => $this->live_tv ?: '',
            'vod' => $this->vod ?: '',
            'series' => $this->series ?: '',
            'catch_up' => $this->catch_up ?: '',
        ];
    }
}
