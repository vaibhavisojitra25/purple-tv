<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppApiKeyResource extends JsonResource
{
    protected $appCode;
    protected $vpn;

    public function additional($data)
    {
        $this->vpn = $data['vpn'];
        $this->appCode = $data['code'];
        return $this;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $vpnUrl = route('getVpns');
        if ($this->vpn->vpn_mode == 'custom') {
            $vpnUrl .= "?code=" . $this->appCode;
        }
        return [
            'imdb_api' => $this->imdb_api ?: '',
            'g_api_key' => $this->g_api_key ?: '',
            'image_imdb' => $this->image_imdb ?: '',
            'trakt_api_key' => $this->trakt_api_key ?: '',
            'weather_api' => $this->weather_api ?: '',
            'ip_stack_key' => $this->ip_stack_key ?: '',
            'check_ip' => $this->check_ip ?: '',
            'vpn_url' => $vpnUrl,
            'vpn_username' => $this->vpn->vpn_username ?: '',
            'vpn_password' => $this->vpn->vpn_password ?: '',
        ];
    }
}
