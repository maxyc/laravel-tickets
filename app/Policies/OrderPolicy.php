<?php

namespace App\Policies;

use App\Order;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return false;
    }

    public function approve(User $user, Order $order)
    {
        return $user->isManager() && $order->isNew();
    }

    public function close(User $user, Order $order)
    {

        return ($user->isManager() || $order->owner_id === $user->id)
            && !$order->isClosed();
    }

    public function answer(User $user, Order $order)
    {
        if ($user->isManager()) {
            return true;
        }

        return $order->owner_id === $user->id && !$order->isClosed();
    }
}
