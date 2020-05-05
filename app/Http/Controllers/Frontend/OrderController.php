<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\AnswerRequest;
use App\Http\Requests\Frontend\CreateOrderRequest;
use App\Http\Requests\Frontend\OrderListRequest;
use App\Order;
use App\UseCases\Order\CreateOrderService;
use App\UseCases\Order\Message\CreateOrderMessageService;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * @var CreateOrderMessageService
     */
    private $createOrderMessageService;
    /**
     * @var CreateOrderService
     */
    private $createOrderService;

    public function __construct(
        CreateOrderService $createOrderService,
        CreateOrderMessageService $createOrderMessageService
    ) {
        $this->createOrderMessageService = $createOrderMessageService;
        $this->createOrderService = $createOrderService;
    }

    public function index(OrderListRequest $request)
    {
        $models = Order::where('owner_id', Auth::user()->id)->paginate();

        return view(
            'web.frontend.sections.orders.index',
            [
                'models' => $models
            ]
        );
    }

    public function create()
    {
        return view('web.frontend.sections.orders.create');
    }

    public function store(CreateOrderRequest $request)
    {
        try {
            $this->createOrderService->create(Auth::user()->id, $request->validated());
            return redirect()->back()->with('success', 'Order created');
        } catch (\Throwable $e) {
            return redirect()->back()->with(
                'error',
                'Order not created. Try again later!'
                . (
                config('app.env') === 'local' ? ' ' . $e->getMessage() : ''
                )
            );
        }
    }

    public function show(Order $order)
    {
        $order->update(['is_read' => true, 'has_answer' => false]);
        return view('web.frontend.sections.orders.show', compact('order'));
    }

    public function answer(AnswerRequest $request, Order $order)
    {
        try {
            $this->createOrderMessageService->create($order->id, Auth::user()->id, $request->validated());
            return redirect()->back()->with('success', 'Message added');
        } catch (\Throwable $e) {
            return redirect()->back()->with(
                'error',
                'Message not added. Try again later!'
                . (
                config('app.env') === 'local' ? ' ' . $e->getMessage() : ''
                )
            );
        }
    }

    public function close()
    {
    }
}
