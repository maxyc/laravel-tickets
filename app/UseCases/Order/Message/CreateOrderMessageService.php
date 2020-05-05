<?php

namespace App\UseCases\Order\Message;

use App\Events\CreateOrderMessageEvent;
use App\Order;
use App\OrderMessage;
use App\User;

class CreateOrderMessageService
{
    public function create(int $orderId, int $ownerId, array $data)
    {
        $order = Order::findOrFail($orderId);
        $owner = User::findOrFail($ownerId);

        $data['owner_id'] = $owner->id;

        $message = OrderMessage::make($data);
        $order->messages()->save($message);

        event(new CreateOrderMessageEvent($message));

        return $message;
    }
}
