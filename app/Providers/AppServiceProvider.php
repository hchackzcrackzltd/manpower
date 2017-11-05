<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Carbon\Carbon;

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
        Validator::extend('checkcanexist','App\validation_user\canexist@checkcanexist','Candidate has selected');
        View::composer(['template.mainuser'],'App\View\authorize');
        View::composer(['user.candidate.index','user.candidate.candidate_detail','mail.notiintcannidate_new',
        'admin.candidate.index_list','admin.candidate.candidate_detail','admin.candidate.list_history'],'App\View\eform_ref');
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
