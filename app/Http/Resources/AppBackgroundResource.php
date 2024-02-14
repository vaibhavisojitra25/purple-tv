<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppBackgroundResource extends JsonResource
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
            'back_remote_change' => $this->back_remote_change == 1 ? "true" : "false",
            'background_auto_change' => $this->background_auto_change == 1 ? "true" : "false",
            'background_mannual_change' => $this->background_mannual_change == 1 ? "true" : "false",
            'background_url' => BackgroundUrlResource::collection($this->backgroundUrls),
            'back_orverlay_remote_change' => $this->back_orverlay_remote_change == 1 ? "true" : "false",
            'background_orverlay_color_code' => $this->background_orverlay_color_code ?: '',
        ];
    }
}
