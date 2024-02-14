<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppDetailResource extends JsonResource
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
            'app_mode' => $this->app_mode,
            'app_mode_universal' => $this->app_mode_universal,
            'in_app_purchase' => new InAppPurchaseResource($this->inAppPurchase),
            'ads' => new AppAdsResource($this->ads),
            'app_conf' => (new AppConfResource($this->settings))->additional($this->package_name),
            'app_dns' => AppDnsResource::collection($this->dns),
            'app_image' => new AppImageResource($this->image),
            'about' => new AppAboutResource($this->aboutus),
            'support' => new AppSupportResource($this->support),
            // 'vpn' => (new AppVpnResource($this->vpn))->additional($this->app_code),
            'version' => new AppVersionResource($this->version),
            'endpoint' => new AppEndPointResource($this->endpoint),
            'api_key' => (new AppApiKeyResource($this->apiKey))->additional(['vpn' => $this->vpn, 'code' => $this->app_code]),
            'weather' => new AppWeatherResource($this->settings),
            'background' => new AppBackgroundResource($this->background),
            'language' => new AppLanguageResource($this->language),
            'themes' => new AppThemeResource($this->theme),
            'player' => new AppPlayerResource($this->player),
            'private_menu' => AppPrivateMenuResource::collection($this->private_menu),
            'app_announce' => AppAnnounceResource::collection($this->announcements),
            'plugin_list' => PluginResourece::collection($this->plugins())
        ];
    }
}
