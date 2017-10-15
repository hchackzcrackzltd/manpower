<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model\User\user_dashboard_detail' => 'App\Policies\request',
        'App\Model\Form\request' => 'App\Policies\requestrec',
        'App\Model\Form\resign' => 'App\Policies\resign',
        'App\Model\User\user_resign_detail' => 'App\Policies\user_resign_detail',
        'App\Model\User\authorize'=>'App\Policies\authorize',
        'App\Model\Masterdata\approve'=>'App\Policies\approve',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
