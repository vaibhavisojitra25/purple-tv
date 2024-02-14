<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppVersionResource extends JsonResource
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
            'version_check' => $this->version_check == 1 ? "true" : "false",
            'version_code' => $this->version_code ? : '',
            'version_name' => $this->version_name ? : '',
            'version_download_url' => $this->play_store_url ? : '',
            'version_download_url_apk' => $this->apk_url ? : '',
            'version_force_update' => $this->force_update == 1 ? "true" : "false",
            'version_update_msg' => $this->version_update_message ? : ''
        ];
    }
}
