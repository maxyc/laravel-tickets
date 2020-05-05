<?php

namespace App\Policies;

use App\Order;
use App\User;
use Carbon\Carbon;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function manage_orders(User $user)
    {
        return $user->isManager();
    }
    public function create_order(User $user)
    {
        $order = $user->getLastOrder();
        return $order && $order->created_at->diffInDays(now()) > 0;
    }

}
