<?php

namespace App\Providers;

use App\Order;
use App\OrderMessage;
use App\Policies\OrderMessagePolicy;
use App\Policies\OrderPolicy;
use App\Policies\UserPolicy;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        User::class => UserPolicy::class,
        Order::class => OrderPolicy::class,
        OrderMessage::class => OrderMessagePolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
