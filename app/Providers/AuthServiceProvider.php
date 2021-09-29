<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\User;
use App\Permission;
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

        if(Schema::hasTable('permissions'))
        {
            $permissions = Permission::all();
            foreach($permissions as $permission)
            {
                Gate::define($permission->permission_name ,function (User $user) use($permission)
                {
                    return $user->hasRole($permission->permission_name)!==null;
                });
            }
        }
    }
}
