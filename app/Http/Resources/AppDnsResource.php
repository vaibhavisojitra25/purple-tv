<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppDnsResource extends JsonResource
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
            'dns_title' => $this->dns_title,
            'url' => $this->url,
            'live_dns' => $this->live_dns ? : '',
            'epg_dns' => $this->epg_dns ? : '',
            'movie_dns' => $this->movie_dns ? : '',
            'series_dns' => $this->series_dns ? : '',
            'catchup_dns' => $this->catchup_dns ? : '',
        ];
    }
}
