<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('checkresign','App\validation_user\manreq@checkresignemp');
        Validator::extend('checkmem','App\validation_user\memreq@checkmemdup');
        Validator::extend('checkdpdup','App\validation_user\dupdpreq@checkdupdp');
        View::composer(['template.mainuser'],'App\View\authorize');
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
