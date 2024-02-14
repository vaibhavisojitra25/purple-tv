<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppLanguageResource extends JsonResource
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
            'defult_language' => $this->defult_language ?: '',
            'firstime_select_language' => $this->firstime_select_language == 1 ? "true" : "false",
        ];
    }
}
