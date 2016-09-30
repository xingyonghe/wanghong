<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Libraries\Seo\SEO;
class SEOServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton('seo', function () {
            return new SEO();
        });

    }
}
