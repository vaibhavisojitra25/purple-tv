<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppEndPointResource extends JsonResource
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
            'm3u_parse' => $this->m3u_parse ? : '#',
            'login' => $this->login ? : '',
            'register' => $this->register ? : '',
            'list_get' => $this->list_get ? : '',
            'list_xstream_update' => $this->list_xstream_update ? : '',
            'deleteurl' => $this->deleteurl ? : '',
            'list_m3u_update' => $this->list_m3u_update ? : '',
            'epg_endpoint' => $this->epg_endpoint ? : '',
        ];
    }
}
