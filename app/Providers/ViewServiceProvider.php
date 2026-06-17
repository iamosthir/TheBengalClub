<?php

namespace App\Providers;

use App\Models\Announcement;
use App\Models\SiteSetting;
use App\Models\SeoSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Share site settings and SEO settings with all views
        View::composer('*', function ($view) {
            $siteSetting        = SiteSetting::first();
            $seoSetting         = SeoSetting::getSettings();
            $activeAnnouncements = Announcement::activeToday()->orderBy('start_date')->get();

            $view->with('siteSetting', $siteSetting);
            $view->with('seoSetting', $seoSetting);
            $view->with('activeAnnouncements', $activeAnnouncements);
        });
    }
}
