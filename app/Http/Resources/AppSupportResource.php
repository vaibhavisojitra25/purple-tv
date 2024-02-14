<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppSupportResource extends JsonResource
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
            'email' => $this->support_email ? : '',
            'web' => $this->support_website ? : '',
            'skype' => $this->support_skype_id ? : '',
            'telegram' => $this->support_telegram_no ? : '',
            'whatsapp' => $this->support_whatsapp_no ? : ''
        ];
    }
}
