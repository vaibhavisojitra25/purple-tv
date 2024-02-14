<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InAppPurchaseResource extends JsonResource
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
            'in_app_purchase_id' => $this->in_app_purchase_id ?: '',
            'lic_key' => $this->in_app_purchase_license_key ?: '',
            'in_app_status' => $this->in_app_status == 1 ? "true" : "false"
        ];
    }
}
