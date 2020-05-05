<?php

namespace App\UseCases\Order;

use App\Events\OrderClosedEvent;
use App\Order;

class UpdateStatusOrderService
{
    public function close(int $orderId)
    {
        $order = Order::findOrFail($orderId);

        if($order->isClosed()) {
            throw new \DomainException('Order already closed');
        }

        $order->update(['status' => Order::STATUS_CLOSED]);

        event(new OrderClosedEvent($order));

        return $order;
    }
}
