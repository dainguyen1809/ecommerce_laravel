<?php

namespace App\Providers;

use App\Models\GeneralSetting;
use App\Models\LogoSetting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register() : void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot() : void
    {
        Paginator::useBootstrap();

        $generalSetting = GeneralSetting::first();
        $logoSetting = LogoSetting::first();

        // set timezone
        Config::set('app.timezone', $generalSetting->timezone);

        // sharing variable at all views 
        View::composer('*', function ($view) use ($generalSetting, $logoSetting) {
            $view->with([
                'settings' => $generalSetting,
                'logoSetting' => $logoSetting,
            ]);
        });
    }
}
