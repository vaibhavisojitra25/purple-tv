<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PluginResourece extends JsonResource
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
            'name' => $this->name,
            'version' => $this->version,
            'playstore_url' => $this->playstore_url,
            'apk_url' => $this->apk_url,
            'status' => $this->status == 1 ? "true" : "false",
            'pkg_name' => $this->pkg_name,
        ];
    }
}
