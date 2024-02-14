<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppAdsResource extends JsonResource
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
            'ads_app_id' => $this->ads_app_id ?: '',
            'ads_banner' => $this->ads_banner ?: '',
            'ads_intrestial' => $this->ads_intrestial ?: '',
            'ads_rewarded' => $this->ads_rewarded ?: '',
            'ads_native' => $this->ads_native ?: '',
            'ads_intrestial_time_delay' => $this->ads_intrestial_time_delay ?: '',
            'ads_ios_status' => $this->ads_ios_status == 1 ? "true" : "false",
            'ads_status' => $this->ads_status == 1 ? "true" : "false",
        ];
    }
}
