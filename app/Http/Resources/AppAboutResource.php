<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppAboutResource extends JsonResource
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
            'description' => $this->description ?: '',
            'developed' => $this->developed_by ?: '',
            'name' => $this->name ?: '',
            'skype' => $this->about_skype_id ?: '',
            'telegram' => $this->about_telegram_no ?: '',
            'whatsapp' => $this->about_whatsapp_no ?: ''
        ];
    }
}
