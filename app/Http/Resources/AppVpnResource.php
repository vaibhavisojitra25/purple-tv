<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppVpnResource extends JsonResource
{
    protected $appCode;

    public function additional($value)
    {
        $this->appCode = $value;
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
        if ($this->vpn_mode == 'custom') {
            $vpnUrl .= "?code=" . $this->appCode;
        }
        return [
            'vpn_mode' => $this->vpn_mode ?: '',
            'vpn_url' => $vpnUrl,
            'vpn_username' => $this->vpn_username ?: '',
            'vpn_password' => $this->vpn_password ?: '',
        ];
    }
}
