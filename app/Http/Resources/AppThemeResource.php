<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppThemeResource extends JsonResource
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
            'theme_defult_layout' => $this->theme_defult_layout ?: '',
            'theme_color_1' => $this->theme_color_1 ?: '',
            'theme_color_2' => $this->theme_color_2 ?: '',
            'theme_color_3' => $this->theme_color_3 ?: '',
            'roku_color_primary' => $this->roku_color_primary ?: '',
            'roku_color_secondary' => $this->roku_color_secondary ?: '',
            'roku_button_focus' => $this->roku_button_focus ?: '',
            'roku_button_unfocus' => $this->roku_button_unfocus ?: '',
            'theme_change' => $this->theme_change == 1 ? "true" : "false",
            'roku_background_overlay' => $this->roku_background_overlay ?: '',
        ];
    }
}
