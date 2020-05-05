<?php

use App\Order;
use App\OrderMessage;
use App\UseCases\Order\CreateOrderService;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * @var CreateOrderService
     */
    private $createOrderService;

    public function __construct(CreateOrderService $createOrderService)
    {
        $this->createOrderService = $createOrderService;
    }

    public function run()
    {
        factory(Order::class, 100)->make()->each(function ($order){
            $order = $this->createOrderService->create($order->ownerId, $order->attributesToArray());

            $order->messages()->createMany(factory(OrderMessage::class, rand(1,10))->make()->toArray());
        });
    }
}
