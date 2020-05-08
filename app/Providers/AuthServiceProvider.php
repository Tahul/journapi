<?php

namespace App\Providers;

use App\Models\Bullet;
use App\Policies\KeyablePolicies\BulletPolicy;
use Givebutter\LaravelKeyable\Facades\Keyable;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
     * The policy mappings for the keyable models.
     *
     * @var array
     */
    protected $keyablePolicies = [
        Bullet::class => BulletPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Keyable::registerKeyablePolicies($this->keyablePolicies);
    }
}
