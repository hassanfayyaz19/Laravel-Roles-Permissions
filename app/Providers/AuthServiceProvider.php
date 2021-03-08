<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

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
        $this->registerpostPolicies();

        //
    }
    public function registerpostPolicies()
    {
        Artisan::call('cache:clear');
        try {
            $permissions = Cache::remember('permissions', 24*60*60, function () {
                return  DB::table('permissions')->get();
            });

            foreach ($permissions as $permission) {
                Gate::define($permission->slug, function ($user) use ($permission) {
                    return  $user->hasAccess([$permission->name]);
                });
            }
        } catch (\Exception $e) {
            return [];
        }

        /* Gate::define('create-post', function ($user) {
        return $user->hasAccess(['create-post']);
        }); */
    }
}
