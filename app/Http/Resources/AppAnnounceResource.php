<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppAnnounceResource extends JsonResource
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
            'title' => $this->title,
            'short_description' => $this->short_description,
            'image' => $this->image ? url('/uploads/inappannouncements', $this->image) : "",
            'created_at' => $this->created_at->format('Y-m-d H:i:s')
        ];
    }
}
