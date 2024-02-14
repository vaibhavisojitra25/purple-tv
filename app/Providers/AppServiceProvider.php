<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        if (file_exists(storage_path('default_conf.json'))) {
            $defaultConf = json_decode(file_get_contents(storage_path('default_conf.json')), true);
            config(['defaultConf' => $defaultConf]);
        }

        Blade::directive('money', function ($amount) {
            if (App::getLocale() == 'de') {
                return "<?php echo number_format($amount, 2, ',', '.'); ?>";
            } else {
                return "<?php echo number_format($amount, 2); ?>";
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
