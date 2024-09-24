<?php

namespace App\Providers;

use App\Models\RedSocial;
use App\Models\SiteData;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        if(Schema::hasTable('red_socials') && Schema::hasTable('site_data'))
            View::share(['socialnetworks'=> RedSocial::all(),'footer'=>SiteData::first()]);

        Schema::defaultStringLength(191);
    }
}
