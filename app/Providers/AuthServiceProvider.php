<?php

namespace App\Providers;

use App\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->registerBpaPolicies();
        //
    }
    public function registerBpaPolicies(){
        if (Schema::hasTable('permissions')) {
        $permissions=Permission::all();
        foreach ($permissions as $perm) {
            $name=$perm->name;
            Gate::define($perm->name, function ($user) use($name){
                return $user->hasAccess($name);
            });
        }
        }

    }
}
