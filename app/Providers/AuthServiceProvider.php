<?php

namespace App\Providers;

use App\Order;
use App\OrderMessage;
use App\Policies\OrderMessagePolicy;
use App\Policies\OrderPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
         Order::class => OrderPolicy::class,
         OrderMessage::class => OrderMessagePolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
