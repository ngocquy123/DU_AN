<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use illuminate\Pagination\Paginator;
use App\Models\Setting;
use Illuminate\Support\Facades\View;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        $websiteSetting = Setting::first();
        View::share('appSetting',$websiteSetting);
    }
}