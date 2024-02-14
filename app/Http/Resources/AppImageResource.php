<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppImageResource extends JsonResource
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
            'app_img' => $this->app_remote_image == 1 ? "true" : "false",
            'app_logo' => $this->app_wide_logo ? url('/uploads/app_images', $this->app_wide_logo) : "",
            'app_mobile_icon' => $this->app_mobile_icon_image ? url('/uploads/app_images', $this->app_mobile_icon_image) : "",
            'app_tv_banner' => $this->tv_banner_image ? url('/uploads/app_images', $this->tv_banner_image) : "",
            'splash_image' => $this->app_splash_screen ? url('/uploads/app_images', $this->app_splash_screen) : "",
            'back_image' => $this->app_background ? url('/uploads/app_images', $this->app_background) : "",
        ];
    }
}
