<?php

namespace App\UseCases\Order;

use App\Events\OrderApprovedEvent;
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

    public function approve(int $orderId)
    {
        $order = Order::findOrFail($orderId);

        if($order->isApproved()) {
            throw new \DomainException('Order already approved');
        }

        $order->update(['status' => Order::STATUS_APPROVED]);

        event(new OrderApprovedEvent($order));

        return $order;
    }
}
