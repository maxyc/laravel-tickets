<?php
namespace App\UseCases\Order;

use App\Events\OrderCreatedEvent;
use App\Order;
use App\User;
use Illuminate\Auth\Events\Registered;

class CreateOrderService
{
    public function create(int $ownerId, array $data)
    {
        $owner = User::findOrFail($ownerId);

        $order = Order::create($data);

        event(new OrderCreatedEvent($order));

        return $order;
    }
}
