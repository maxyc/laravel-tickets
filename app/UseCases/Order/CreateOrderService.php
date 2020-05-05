<?php
namespace App\UseCases\Order;

use App\Events\OrderCreatedEvent;
use App\Order;
use Illuminate\Auth\Events\Registered;

class CreateOrderService
{
    public function create(array $data)
    {
        $order = Order::create($data);

        event(new OrderCreatedEvent($order));

        return $order;
    }
}
