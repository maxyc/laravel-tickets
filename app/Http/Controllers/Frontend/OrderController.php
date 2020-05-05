<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\AnswerRequest;
use App\Http\Requests\Frontend\OrderListRequest;
use App\Order;
use App\UseCases\Order\Message\CreateOrderMessageService;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * @var CreateOrderMessageService
     */
    private $createOrderMessageService;

    public function __construct(CreateOrderMessageService $createOrderMessageService)
    {
        $this->createOrderMessageService = $createOrderMessageService;
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

    public function store()
    {
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
        } catch (\Throwable $e) { dd($e);
            return redirect()->back()->with(
                'error',
                'Message not added. Try later!'
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
