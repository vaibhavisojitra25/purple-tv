<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppPrivateMenuResource extends JsonResource
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
            'addtion_app_icon' => $this->addtion_app_icon ? url('uploads/app_menu', $this->addtion_app_icon) : '',
            'addtion_app_name' => $this->addtion_app_name ?: '',
            'addtion_app_pkg' => $this->addtion_app_pkg ?: '',
            'addtion_app_url' => $this->addtion_app_url ?: '',
            'addtion_app_status' => $this->addtion_app_status,
        ];
    }
}
