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
        $ownerId = 2;
        factory(Order::class, 100)->make(['owner_id' => $ownerId])->each(function ($order) use ($ownerId){
            $order = $this->createOrderService->create($ownerId, $order->attributesToArray());

            $order->messages()->createMany(factory(OrderMessage::class, random_int(1, 10))->make()->toArray());
        });
    }
}
